<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
class GetallPagesController extends Controller
{
    public function getallPages(Request $request)
    {
        $pages = Pages::all();
                     $table="<div class='table-responsive'><table class='table table-striped'><thead>
                     <th>S|No</th>
                     <th>Page Name</th>
                     <th>Child Of</th>
                     <th>Link</th>
                     <th>Icon</th>
                     <th>Action</th>
                     <th>Preciew<th></thead>";
$sn=0;
        foreach ($pages as $page) {
            $sn++;
             if($page->parent==0){
                     $child="Parent";
                 }else{
                    $child="Child"; 
                 }
             $table.="<tr>
             <td>".$sn."</td>
             <td>".$page->Page_Name."</td>
             <td>".$child."</td>
             <td>".$page->link."</td>
             <td>".$page->icon."</td>
             <td><a href='EditContent.php?link=".$page->link."' class='btn btn-sm btn-primary'>Edit Page</a> <button  class='btn btn-sm btn-light DeletePage' id='".$page->id."'>Delete Page</button></td>
             <td><a href='https://www.3iqtrading.org/".$page->link."' class='btn btn-sm btn-primary'>Preview Page</a>
             </td></tr>";
        }
        $table.="</table></div>";
        return response()->json($table);
    }
}
