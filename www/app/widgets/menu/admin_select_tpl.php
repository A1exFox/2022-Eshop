
$parent_id = \wfm\App::$app->getProperty('parent_id');
$get_id = get('id');


<option value=" $id "  if ($id == $parent_id) echo ' selected';   if ($get_id == $id) echo ' disabled'; >
     $tab . $category['title'] 
</option>
 if(isset($category['children'])): 
     $this->getMenuHtml($category['children'], '&nbsp;' . $tab. '-') 
 endif; 
