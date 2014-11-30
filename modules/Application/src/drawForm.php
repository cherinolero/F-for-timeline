<?php 

/**
 * Dibuja un formulario desde una definicion en array
 * 
 * @param unknown $formDefinition
 * @return unknown
 */

function drawForm($formDefinition, $action, $method='post')
{
    $html='';
    
    echo getcwd();
    
    $html.=chr(13)."<form  role=\"form\" action=\"../ffortimeline/".$action."\" method=\"".$method."\">";
    
    foreach ($formDefinition as $key => $value)
    {
        
        switch ($value['type'])
        {
            case 'text':
                $html.=chr(13).'<div class="form-group">'
                        .chr(13)."<label for=\"".$value['name']."\">".$value['label']."</label>
                            <input class=\"form-control\" type=\"".$value['type']."\" 
                                placeholder=\"".$value['placeholder']."\"
                                name=\"".$value['name']."\" 
                                value=\"".$value['defaultValue']."\">";
                $html.='</div>';
            break;

            case 'textarea':
                $html.=chr(13).'<div class="form-group">'
                        .chr(13)."<label for=\"".$value['name']."\">".$value['label']."</label>
                        <textarea class=\"form-control\" name=\"".$value['name']."\"
                           placeholder=\"".$value['placeholder']."\"
                             maxlength=\"1000\" rows=\"5\">
                        </textarea>";
                $html.='</div>';
            break;
                        
            case 'select-simple': 
                $html.=chr(13).'<div class="form-group">'
                        .chr(13)."<label for=\"".$value['name']."\">".$value['label']."</label>
                        <select class=\"form-control\" name=".$value['name'].">";
                // 
                foreach ($value['values'] as $key => $selectValue)
                {
                    $html.="<option value=\"".$key."\">".$selectValue."</option>";
                }                
                $html.="</select>";
                $html.='</div>';
            break;

            case 'select-multiple':
                $html.=chr(13).'<div class="form-group">'
                        .chr(13)."<label for=\"".$value['name']."\">".$value['label']."</label>
                        <select class=\"form-control\" name=".$value['name']."[] MULTIPLE>";
                foreach ($value['values'] as $key => $selectValue)
                {
                    $html.="<option value=\"".$key."\">".$selectValue."</option>";
                }
                $html.="</select>";
                $html.='</div>';
            break;
                        
            case 'submit':
                $html.=chr(13)."<div id=\"buttons\">";
                
                $html.=chr(13)."<input type=\"".$value['type']."\" 
                               name=\"".$value['name']."\"  
                              class=\"btn btn-default\"                                   
                              value=\"".$value['defaultValue']."\" 
                         />";
                
                $html.=chr(13).'</div>';
                
            break;
         
        }
    }
        
    $html.=chr(13).'</form>';
    
    return $html;
}
