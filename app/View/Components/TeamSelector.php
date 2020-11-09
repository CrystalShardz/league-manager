<?php

namespace App\View\Components;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TeamSelector extends Component
{
    public array $selected = [];
    public string $name = '';
    public string $id = '';
    public bool $multiple = false;
    public string $placeholder = '';
    public bool $allowCustomTeams = false;

    public Collection $teams;

    /**
     * Create a new component instance.
     *
     * @param array $selected
     * @param string $name
     * @param string $id
     * @param bool $multiple
     * @param string $placeholder
     * @param bool $allowCustomTeams
     */
    public function __construct(array $selected = [], string $name = '', string $id = '', bool $multiple = false, string $placeholder = 'Select Team', bool $allowCustomTeams = false)
    {
        $this->selected = $selected;
        $this->name = $name;
        $this->id = $id;
        $this->multiple = $multiple;
        $this->placeholder = $placeholder;
        $this->allowCustomTeams = $allowCustomTeams;

        $this->loadTeams();
    }

    private function loadTeams()
    {
        $this->teams = Team::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.team-selector');
    }

    public function isSelected($option)
    {
        return in_array($option, $this->selected);
    }
}
