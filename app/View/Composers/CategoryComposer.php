<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryComposer
{
    protected $users;

    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $categories = Category::orderByDesc('id')->get();

        $view->with('categories', $categories);
    }
}
