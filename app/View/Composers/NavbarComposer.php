<?php

namespace App\View\Composers;

use App\Models\User;
use Illuminate\View\View;

class NavbarComposer
{
    public function compose(View $view): void
    {
        $view->with('navbar_view', $this->resolveNavbarView());
    }

    private function resolveNavbarView(): string
    {
        switch (session()->get('user_type')) {
            case 1:
                return \view('control_panel.partials.navbar.admin')->render();

            case 2:
                return  \view('control_panel.partials.navbar.shop')->render();

            case 3:
                return \view('control_panel.partials.navbar.financial_company')->render();

            default:
                return '';
        }
    }
}
