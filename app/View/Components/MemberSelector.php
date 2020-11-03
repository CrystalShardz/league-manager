<?php

namespace App\View\Components;

use App\Models\Member;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class MemberSelector extends Component
{
    public array $selected = [];
    public string $name = '';
    public string $id = '';
    public bool $multiple = false;
    public string $placeholder = '';
    public bool $allowCustomMembers = false;

    public Collection $members;

    private int $team = 0;

    /**
     * Create a new component instance.
     *
     * @param array $selected
     * @param string $name
     * @param string $id
     * @param bool $multiple
     */
    public function __construct(array $selected = [], string $name = '', string $id = '', bool $multiple = false, int $team = 0, string $placeholder = 'Select Member', bool $allowCustomMembers = false)
    {
        $this->selected = $selected;
        $this->name = $name;
        $this->id = $id;
        $this->multiple = $multiple;
        $this->team = $team;
        $this->placeholder = $placeholder;
        $this->allowCustomMembers = $allowCustomMembers;

        $this->loadMembers();
    }

    private function loadMembers()
    {
        if ($this->team > 0) {
            $team = Team::find($this->team)->members;
        } else {
            $this->members = Member::all();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.member-selector');
    }

    public function isSelected($option)
    {
        return in_array($option, $this->selected);
    }
}
