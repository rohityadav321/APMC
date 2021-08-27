 <tbody>
     <?php
        $i = 1;

        if (!empty($GodownDetail)) {
            foreach ($GodownDetail as $List) {
        ?>
             <tr>
                 <!-- <td height="10"><?php echo $i; ?></td> -->
                 <td></td>
                 <td><?php echo $List->IDNumber; ?></td>
                 <td><?php echo $List->LotNo; ?></td>
                 <td><?php echo $List->ItemCode; ?></td>
                 <td><?php echo $List->ItemName; ?></td>
                 <td><?php echo $List->Mark; ?></td>
                 <td><?php echo $List->GodownID; ?></td>
                 <td><?php echo $List->SalesTitle; ?></td>
                 <td><?php echo $List->BalQty; ?></td>
                 <td><?php echo $List->Packing; ?></td>
                 <td><?php echo $List->GoodsRcptDate; ?></td>
                 <td><?php echo $List->AE; ?></td>
                 <td><?php echo $List->Star; ?></td>


                 <!--  <td align="center">
                              <a data-dismiss="modal" id="closeAccount" href="javascript:void(0);" onclick="GodownWiseList('<?php echo $List->IDNumber; ?>','<?php echo $List->LotNo; ?>','<?php echo $List->ItemCode; ?>','<?php echo $List->ItemName; ?>','<?php echo $List->Mark; ?>','<?php echo $List->GodownID; ?>','<?php echo $List->BalQty; ?>','<?php echo $List->Units; ?>','<?php echo $List->Packing; ?>','<?php echo $List->GoodsRcptDate; ?>','<?php echo $List->AE; ?>','<?php echo $List->Star; ?>','<?php echo $List->Weight; ?>','<?php echo $List->PackingChrg; ?>','<?php echo $List->TaxCode; ?>','<?php echo $List->TaxRate; ?>','<?php echo $List->Laga; ?>','<?php echo $List->APMCChg; ?>','<?php echo $List->APMCSChg; ?>','<?php echo $List->EntryTax; ?>');">
                              <i class="glyphicon glyphicon-check"></i></a>
                            </td> -->
             </tr>

     <?php
                $i++;
            }
        } else {
            echo "No Data found";
        } ?>
 </tbody>