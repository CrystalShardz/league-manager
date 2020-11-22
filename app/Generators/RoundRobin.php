<?php

namespace App\Generators;

use App\Contracts\Generator;
use App\Models\Fixture;
use App\Models\Location;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Models\Team;

class RoundRobin implements Generator
{
    private int $roundsToGenerate = 1;
    private Season $season;
    private bool $autoSave = false;

    public function __construct(Season $season, int $numRounds = 1, bool $autoSave = false)
    {
        $this->roundsToGenerate = $numRounds ?? 1;
        $this->season = $season;
        $this->autoSave = $autoSave;
    }

    /**
     * @return Collection
     */
    public function generate(): Collection
    {
        $rounds = new Collection();
        for ($i = 0; $i < $this->roundsToGenerate; $i++) {
            $rounds->add($this->generateRound(($i % 2 == 0)));
        }

        return $rounds;
    }

    /**
     * Generates a single round
     *
     * @param bool $invertSides Should we invert the sides? (home becomes away, away becomes home)
     * @return Collection
     */
    private function generateRound(bool $invertSides = false): Collection
    {
        /**
         * @var Collection $teams
         */
        $teams = $this->season->teams;
        /**
         * @var Carbon $fixtureDate
         */
        $fixtureDate = $this->season->date_start;

        $numTeams = $teams->count();
        $useBlind = false;

        if ($numTeams % 2 != 0) {
            $useBlind = true;
            $t = new Team();
            $t->name = 'BLIND';
            $teams->add($t);
            $numTeams++;
        }

        $round = new Collection();

        [$teams_a, $teams_b] = $teams->split(2);

        $numWeeks = $numTeams - 1;
        $fixturesPerWeek = $teams_a->count();

        for ($w = 0; $w < $numWeeks; $w++) {
            $week = new Collection();
            for ($f = 0; $f < $fixturesPerWeek; $f++) {
                if ($teams_a[$f]->name == 'BLIND' || $teams_b[$f]->name == 'BLIND') {
                    // Skip blind fixture
                    continue;
                }

                $fixture = new Fixture();
                $fixture->location()->associate(Location::first());
                $fixture->start_at = $fixtureDate;
                if ($invertSides) {
                    $fixture->home_id = $teams_b[$f]->id;
                    $fixture->away_id = $teams_a[$f]->id;
                } else {
                    $fixture->home_id = $teams_a[$f]->id;
                    $fixture->away_id = $teams_b[$f]->id;
                }
                $week->add($fixture);
            }
            $round->add($week);
            // Rotate teams
            $this->rotateTeams($teams_a, $teams_b);
            // Advance start date_time to next week
            $fixtureDate = $fixtureDate->addWeek();

            if ($this->autoSave) {
                $this->season->fixtures()->saveMany($week);
            }
        }

        return $round;
    }

    /**
     * Rotate teams to create a circular pattern
     *
     * @param Collection $teams_a
     * @param Collection $teams_b
     */
    private function rotateTeams(Collection &$teams_a, Collection &$teams_b): void
    {
        $lastA = $teams_a->pop();
        $firstB = $teams_b->shift();

        $teams_a->splice(2, 0, [$firstB]);
        $teams_b->add($lastA);

        // Reset collection array keys
        $teams_a = $teams_a->values();
        $teams_b = $teams_b->values();
    }
}
