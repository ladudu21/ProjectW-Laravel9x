<?php

function showCategoryTree($categories, $parent_id = 0, $char = '')
{
    global $deleteButton;
    $html = '';
    foreach ($categories as $category) {
        if ($category->parent_id == $parent_id) {
            $html .= '
                    <tr>
                        <td>' . $category->id . '</td>
                        <td>' . $char . $category->name . '</td>'
                .
                '<td>' . $category->updated_at . '</td>
                        <td class="text-right"> 
                            <a class = "btn btn-primary" href="/admin/categories/' . $category->id . '/edit" >
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button type="submit" class="btn btn-danger" onclick="removeRow(\'/admin/categories/' . $category->id . '\')"> 
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                ';
            $html .= showCategoryTree($categories, $category->id, $char . '|--');
        }
    }
    return $html;
}

function showCategoryClient($categories, $parent_id = 0)
{
    $html = '';
    foreach ($categories as $category) {
        if ($category->parent_id ==  $parent_id) {
            $url = route('category_filter', $category);
            $html .= '
                    <li class="dropdown-submenu">
                        <a tabindex="-1" href="' . $url . '">' . $category->name . '</a>';
            if (isChild($categories, $category->id)) {
                $html .= '<ul class="sub-menu">';
                $html .= showCategoryClient($categories, $category->id);
                $html .= '</ul>';
            }
            $html .= '</li>
                ';
        }
    }
    return $html;
}
//danh muc con trang user
function isChild($categories, $id): bool
{
    foreach ($categories as $category) {
        if ($category->parent_id == $id) {
            return true;
        }
    }
    return false;
}
