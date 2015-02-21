<?php

App::uses('AppHelper', 'View');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UtilitymethodsHelper extends AppHelper {

    /**
     * 
     * @param array $arrPedigree
     * @param string $modelName
     * @param string $textField
     * @param string $toolTip
     * @return string Html
     */
    public function createBinaryTree($arrPedigree = null, $modelName = "User", $link = false, $textField = "name") {
        if (is_array($arrPedigree)) {
            //print_r($arrPedigree);
            $heredoc = '';

            foreach ($arrPedigree as $nodeKey => $nodeValue) {

                $title = '';
                

                $cntChild = @count($arrPedigree[$nodeKey]['children']);
                $heredoc.= "<td valign='top' align='center'>
                                    <table width='100' border='0' align='center' cellpadding='0' cellspacing='2'>
                                        <tr valign='top'  align='center'>
                                            <td align='center' width='100%' colspan='{$cntChild}' valign='top'>
                                                <table style='cursor:pointer' width='150' height='100%' border='0' align='center' cellpadding='0' cellspacing='5' class='pedigree_node'>
                                                    <tr>
                                                    <p id='container'>
                                                        <td align='center' valign='middle' width='100%' data-id='{$arrPedigree[$nodeKey][$modelName]['id']}' data-popover='true' data-html=true >
                                                    </p>                                                      
                                                    <a href='$link/{$arrPedigree[$nodeKey][$modelName]['id']}'>
                                                           <span><i class='fa fa-user'></i></span>
                                                           <strong>{$arrPedigree[$nodeKey][$modelName][$textField]}</strong>
                                                         </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>";

                if ($cntChild != 0) {
                    if ($cntChild == 1) {
                        $heredoc.= "<tr><td class='tree_vertical_line' height='20'>|</td></tr>";
                    } else {
                        $heredoc.= "<tr><td class='tree_vertical_line' height='20' colspan='{$cntChild}'>|</td></tr><tr>";
                        for ($i = 1; $i <= $cntChild; $i++) {
                            if ($i == 1) {
                                $className1 = '';
                            } else {
                                $className1 = 'tree_right_top_line';
                            }

                            if ($i == $cntChild) {
                                $className2 = '';
                            } else {
                                $className2 = 'tree_left_top_line';
                            }
                            $heredoc.= "<td height='20'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                                                    <tr>
                                                        <td width='50%' class='{$className1}'>&nbsp;</td>
                                                        <td width='50%' class='{$className2}'>&nbsp;</td>
                                                    </tr>
                                                </table>
                                             </td>";
                        }
                        $heredoc.= '</tr>';
                    }
                }

                $heredoc.= $this->createBinaryTree($arrPedigree[$nodeKey]['children'], $modelName, $link, $textField);

                $heredoc.= '</table></td>';
            }

            return $heredoc;
        }
    }

}
