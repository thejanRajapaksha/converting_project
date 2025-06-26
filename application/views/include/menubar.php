<?php 
$controllermenu=$this->router->fetch_class();
$functionmenu=uri_string();
$functionmenu2=$this->router->fetch_method();

$menuprivilegearray=$menuaccess;

if ($functionmenu2 == 'Useraccount') {
    $addcheck = checkprivilege($menuprivilegearray, 1, 1);
    $editcheck = checkprivilege($menuprivilegearray, 1, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 1, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 1, 4);
} 
else if ($functionmenu2 == 'Usertype') {
    $addcheck = checkprivilege($menuprivilegearray, 2, 1);
    $editcheck = checkprivilege($menuprivilegearray, 2, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 2, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 2, 4);
} 
else if ($functionmenu2 == 'Userprivilege') {
    $addcheck = checkprivilege($menuprivilegearray, 3, 1);
    $editcheck = checkprivilege($menuprivilegearray, 3, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 3, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 3, 4);
} 
else if($functionmenu=='MachineTypes') {
    $addcheck = checkprivilege($menuprivilegearray, 4, 1);
    $editcheck = checkprivilege($menuprivilegearray, 4, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 4, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 4, 4);
} 
else if ($functionmenu == 'MachineModels') {
    $addcheck = checkprivilege($menuprivilegearray, 5, 1);
    $editcheck = checkprivilege($menuprivilegearray, 5, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 5, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 5, 4);
} 
else if ($functionmenu == 'MachineBrands') {
    $addcheck = checkprivilege($menuprivilegearray, 6, 1);
    $editcheck = checkprivilege($menuprivilegearray, 6, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 6, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 6, 4);
} 
else if ($functionmenu == 'MachineIn') {
    $addcheck = checkprivilege($menuprivilegearray, 7, 1);
    $editcheck = checkprivilege($menuprivilegearray, 7, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 7, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 7, 4);
} 
else if ($functionmenu == 'SpareParts') {
    $addcheck = checkprivilege($menuprivilegearray, 8, 1);
    $editcheck = checkprivilege($menuprivilegearray, 8, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 8, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 8, 4);
} 
else if ($functionmenu == 'Materialmaincategory') {
    $addcheck = checkprivilege($menuprivilegearray, 9, 1);
    $editcheck = checkprivilege($menuprivilegearray, 9, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 9, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 9, 4);
} 
else if ($functionmenu == 'Rowmaterials') {
    $addcheck = checkprivilege($menuprivilegearray, 10, 1);
    $editcheck = checkprivilege($menuprivilegearray, 10, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 10, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 10, 4);
} 
else if ($functionmenu == 'Fliinformation') {
    $addcheck = checkprivilege($menuprivilegearray, 11, 1);
    $editcheck = checkprivilege($menuprivilegearray, 11, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 11, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 11, 4);
} 
else if ($functionmenu == 'Cuttype') {
    $addcheck = checkprivilege($menuprivilegearray, 12, 1);
    $editcheck = checkprivilege($menuprivilegearray, 12, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 12, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 12, 4);
} 
else if ($functionmenu == 'MachineService') {
    $addcheck = checkprivilege($menuprivilegearray, 13, 1);
    $editcheck = checkprivilege($menuprivilegearray, 13, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 13, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 13, 4);
} 
else if ($functionmenu2 == 'allocate') {
    $addcheck = checkprivilege($menuprivilegearray, 14, 1);
    $editcheck = checkprivilege($menuprivilegearray, 14, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 14, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 14, 4);
} 
else if ($functionmenu2 == 'issue') {
    $addcheck = checkprivilege($menuprivilegearray, 15, 1);
    $editcheck = checkprivilege($menuprivilegearray, 15, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 15, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 15, 4);
} 
else if ($functionmenu2 == 'receive') {
    $addcheck = checkprivilege($menuprivilegearray, 16, 1);
    $editcheck = checkprivilege($menuprivilegearray, 16, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 16, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 16, 4);
} 
else if ($functionmenu == 'MachineServicesCalendar') {
    $addcheck = checkprivilege($menuprivilegearray, 17, 1);
    $editcheck = checkprivilege($menuprivilegearray, 17, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 17, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 17, 4);
} 
else if ($functionmenu == 'MachineRepairRequests') {
    $addcheck = checkprivilege($menuprivilegearray, 18, 1);
    $editcheck = checkprivilege($menuprivilegearray, 18, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 18, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 18, 4);
} 
else if ($functionmenu == 'Newpurchaserequest') {
    $addcheck = checkprivilege($menuprivilegearray, 19, 1);
    $editcheck = checkprivilege($menuprivilegearray, 19, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 19, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 19, 4);
    $approvecheck=checkprivilege($menuprivilegearray, 19, 5);
    $checkstatus=checkprivilege($menuprivilegearray, 19, 6);
} 
else if ($functionmenu == 'Purchaseorder') {
    $addcheck = checkprivilege($menuprivilegearray, 20, 1);
    $editcheck = checkprivilege($menuprivilegearray, 20, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 20, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 20, 4);
    $approvecheck=checkprivilege($menuprivilegearray, 20, 5);
} 
else if ($functionmenu == 'Goodreceivenote') {
    $addcheck = checkprivilege($menuprivilegearray, 21, 1);
    $editcheck = checkprivilege($menuprivilegearray, 21, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 21, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 21, 4);
} 
else if ($functionmenu == 'Goodreceivenotevoucher') {
    $addcheck = checkprivilege($menuprivilegearray, 22, 1);
    $editcheck = checkprivilege($menuprivilegearray, 22, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 22, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 22, 4);
} 
else if ($functionmenu == 'Goodreceivenotereturn') {
    $addcheck = checkprivilege($menuprivilegearray, 23, 1);
    $editcheck = checkprivilege($menuprivilegearray, 23, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 23, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 23, 4);
} 
else if ($functionmenu == 'CRMInquiry') {
    $addcheck = checkprivilege($menuprivilegearray, 24, 1);
    $editcheck = checkprivilege($menuprivilegearray, 24, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 24, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 24, 4);
} 
else if ($functionmenu == 'CRMQuotation') {
    $addcheck = checkprivilege($menuprivilegearray, 25, 1);
    $editcheck = checkprivilege($menuprivilegearray, 25, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 25, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 25, 4);
} 
else if ($functionmenu == 'CRMQuotationStatus') {
    $addcheck = checkprivilege($menuprivilegearray, 26, 1);
    $editcheck = checkprivilege($menuprivilegearray, 26, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 26, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 26, 4);
} 
else if ($functionmenu == 'CRMReason') {
    $addcheck = checkprivilege($menuprivilegearray, 27, 1);
    $editcheck = checkprivilege($menuprivilegearray, 27, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 27, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 27, 4);
} 
else if ($functionmenu == 'CRMOrderdetail') {
    $addcheck = checkprivilege($menuprivilegearray, 28, 1);
    $editcheck = checkprivilege($menuprivilegearray, 28, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 28, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 28, 4);
} 
else if ($functionmenu == 'CRMDeliverydetail') {
    $addcheck = checkprivilege($menuprivilegearray, 29, 1);
    $editcheck = checkprivilege($menuprivilegearray, 29, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 29, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 29, 4);
} 
else if ($functionmenu == 'CRMCompletedorder') {
    $addcheck = checkprivilege($menuprivilegearray, 30, 1);
    $editcheck = checkprivilege($menuprivilegearray, 30, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 30, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 30, 4);
} 
else if ($functionmenu == 'Machinealloction') {
    $addcheck = checkprivilege($menuprivilegearray, 31, 1);
    $editcheck = checkprivilege($menuprivilegearray, 31, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 31, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 31, 4);
} 
else if ($functionmenu == 'AllocatedMachines') {
    $addcheck = checkprivilege($menuprivilegearray, 32, 1);
    $editcheck = checkprivilege($menuprivilegearray, 32, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 32, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 32, 4);
} 
else if ($functionmenu == 'Stock') {
    $addcheck = checkprivilege($menuprivilegearray, 33, 1);
    $editcheck = checkprivilege($menuprivilegearray, 33, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 33, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 33, 4);
} 
else if ($functionmenu == 'Goodreceive') {
    $addcheck = checkprivilege($menuprivilegearray, 34, 1);
    $editcheck = checkprivilege($menuprivilegearray, 34, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 34, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 34, 4);
    $approvecheck=checkprivilege($menuprivilegearray, 34, 5);
} 
else if ($functionmenu == 'Servicecreatedlist') {
    $addcheck = checkprivilege($menuprivilegearray, 35, 1);
    $editcheck = checkprivilege($menuprivilegearray, 35, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 35, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 35, 4);
} 
else if ($functionmenu == 'MachineRepairsEmployee') {
    $addcheck = checkprivilege($menuprivilegearray, 36, 1);
    $editcheck = checkprivilege($menuprivilegearray, 36, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 36, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 36, 4);
} 
else if ($functionmenu == 'Servicecostanalysis') {
    $addcheck = checkprivilege($menuprivilegearray, 37, 1);
    $editcheck = checkprivilege($menuprivilegearray, 37, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 37, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 37, 4);
} 
else if ($functionmenu == 'Usedserviceitems') {
    $addcheck = checkprivilege($menuprivilegearray, 38, 1);
    $editcheck = checkprivilege($menuprivilegearray, 38, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 38, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 38, 4);
} 
else if ($functionmenu == 'Repaircreatedlist') {
    $addcheck = checkprivilege($menuprivilegearray, 39, 1);
    $editcheck = checkprivilege($menuprivilegearray, 39, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 39, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 39, 4);
} 
else if ($functionmenu == 'Employeerepairs') {
    $addcheck = checkprivilege($menuprivilegearray, 40, 1);
    $editcheck = checkprivilege($menuprivilegearray, 40, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 40, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 40, 4);
} 
else if ($functionmenu == 'MachineRepairsCostAnalysis') {
    $addcheck = checkprivilege($menuprivilegearray, 41, 1);
    $editcheck = checkprivilege($menuprivilegearray, 41, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 41, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 41, 4);
} 
else if ($functionmenu == 'UsedRepairItems') {
    $addcheck = checkprivilege($menuprivilegearray, 42, 1);
    $editcheck = checkprivilege($menuprivilegearray, 42, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 42, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 42, 4);
} 
else if ($functionmenu == 'MachineWIP') {
    $addcheck = checkprivilege($menuprivilegearray, 43, 1);
    $editcheck = checkprivilege($menuprivilegearray, 43, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 43, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 43, 4);
} 
else if ($functionmenu == 'CustomerPOWIP') {
    $addcheck = checkprivilege($menuprivilegearray, 44, 1);
    $editcheck = checkprivilege($menuprivilegearray, 44, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 44, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 44, 4);
} 
else if ($functionmenu2 == 'return_to_stock') {
    $addcheck = checkprivilege($menuprivilegearray, 45, 1);
    $editcheck = checkprivilege($menuprivilegearray, 45, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 45, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 45, 4);
} 
else if ($functionmenu2 == 'return_accept') {
    $addcheck = checkprivilege($menuprivilegearray, 46, 1);
    $editcheck = checkprivilege($menuprivilegearray, 46, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 46, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 46, 4);
} 
else if ($functionmenu2 == 'return_to_supplier') {
    $addcheck = checkprivilege($menuprivilegearray, 47, 1);
    $editcheck = checkprivilege($menuprivilegearray, 47, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 47, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 47, 4);
} 
else if ($functionmenu2 == 'return_to_supplier_approve_front') {
    $addcheck = checkprivilege($menuprivilegearray, 48, 1);
    $editcheck = checkprivilege($menuprivilegearray, 48, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 48, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 48, 4);
} 
else if ($functionmenu == 'Customer') {
    $addcheck = checkprivilege($menuprivilegearray, 49, 1);
    $editcheck = checkprivilege($menuprivilegearray, 49, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 49, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 49, 4);
} 
else if ($functionmenu == 'Supplier') {
    $addcheck = checkprivilege($menuprivilegearray, 50, 1);
    $editcheck = checkprivilege($menuprivilegearray, 50, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 50, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 50, 4);
}
else if ($functionmenu == 'CRMQuotationform') {
    $addcheck = checkprivilege($menuprivilegearray, 51, 1);
    $editcheck = checkprivilege($menuprivilegearray, 51, 2);
    $statuscheck = checkprivilege($menuprivilegearray, 51, 3);
    $deletecheck = checkprivilege($menuprivilegearray, 51, 4);
}


 
function checkprivilege($arraymenu, $menuID, $type){
    foreach($arraymenu as $array){
        if($array->menuid==$menuID){
            if($type==1){
                return $array->add;
            }
            else if($type==2){
                return $array->edit;
            }
            else if($type==3){
                return $array->statuschange;
            }
            else if($type==4){
                return $array->remove;
            }
            else if($type==5){
                return $array->approvestatus;
            }
            else if($type==6){
                return $array->checkstatus;
            }
        }
    }
}
?>
<textarea class="d-none" id="actiontext"><?php if($this->session->flashdata('msg')) {echo $this->session->flashdata('msg');} ?></textarea>

<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <div class="sidenav-menu-heading">Core</div>
            <a class="nav-link p-0 px-3 py-2 text-dark" href="<?php echo base_url().'Welcome/Dashboard'; ?>">
                <div class="nav-link-icon"><i class="fas fa-desktop"></i></div>
                Dashboard
            </a>

            <!-- Machine -->
            <?php if(menucheck($menuprivilegearray, 4)==1 | menucheck($menuprivilegearray, 4)==1 | menucheck($menuprivilegearray, 5)==1 | menucheck($menuprivilegearray, 6)==1 | menucheck($menuprivilegearray, 7)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseMachine" aria-expanded="false">
                <div class="nav-link-icon"><i class="fas fa-cogs"></i></div>
                Machine
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($controllermenu=="MachineTypes" | $controllermenu=="MachineModels" | $controllermenu=="MachineBrands" | $controllermenu=="MachineIn"){echo 'show';} ?>" id="collapseMachine" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    <?php if(menucheck($menuprivilegearray, 4)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineTypes'; ?>">Machine Types</a>
                    <?php } if(menucheck($menuprivilegearray, 5)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineModels'; ?>">Machine Models</a>
                    <?php } if(menucheck($menuprivilegearray, 6)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineBrands'; ?>">Machine Brands</a>
                    <?php } if(menucheck($menuprivilegearray, 7)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineIn'; ?>">Machine In</a>
                    <?php } ?>
                </nav>
            </div>
            <?php } ?>

            <!-- Spare Parts -->
            <?php if(menucheck($menuprivilegearray, 8)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 text-dark" href="<?php echo base_url().'SpareParts'; ?>">
                <div class="nav-link-icon"><i class="fas fa-tools"></i></div>
                Spare Parts
            </a>
            <?php } ?>

            <?php if(menucheck($menuprivilegearray, 51)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 text-dark" href="<?php echo base_url().'CRMQuotationform/Getquotation'; ?>">
                <div class="nav-link-icon"><i class="fas fa-tools"></i></div>
                CRM Quotation Form
            </a>
            <?php } ?>

            <!-- Material Data -->
            <?php if(menucheck($menuprivilegearray, 9)==1 | menucheck($menuprivilegearray, 10)==1 | menucheck($menuprivilegearray, 11)==1 | menucheck($menuprivilegearray, 12)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseMaterialData">
                <div class="nav-link-icon"><i class="fas fa-boxes"></i></div>
                Material Data
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($controllermenu=="Materialmaincategory" | $controllermenu=="Rowmaterials" | $controllermenu=="Fliinformation" | $controllermenu=="CutType"){echo 'show';} ?>" id="collapseMaterialData" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    <?php if(menucheck($menuprivilegearray, 9)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Materialmaincategory'; ?>">Material Main Category</a>
                    <?php } if(menucheck($menuprivilegearray, 10)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Rowmaterials'; ?>">Row Materials</a>
                    <?php } if(menucheck($menuprivilegearray, 11)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Fliinformation'; ?>">Fli Information</a>
                    <?php } ?>
                </nav>
            </div>
            <?php } ?>

            <!-- Machine Services -->
            <?php if(menucheck($menuprivilegearray, 13)==1 | menucheck($menuprivilegearray, 14)==1 | menucheck($menuprivilegearray, 15)==1 | menucheck($menuprivilegearray, 16)==1 | menucheck($menuprivilegearray, 17)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseMachineServices">
                <div class="nav-link-icon"><i class="fas fa-wrench"></i></div>
                Machine Services
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($controllermenu=="MachineService" | $controllermenu=="allocate" | $controllermenu=="issue" | $controllermenu=="receive" | $controllermenu=="MachineServicesCalendar"){echo 'show';} ?>" id="collapseMachineServices" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    <?php if(menucheck($menuprivilegearray, 13)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineService'; ?>">Machine Service</a>
                    <?php } if(menucheck($menuprivilegearray, 14)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineService/allocate'; ?>">Service Item Allocate</a>
                    <?php } if(menucheck($menuprivilegearray, 15)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineService/issue'; ?>">Service Item Issue</a>
                    <?php } if(menucheck($menuprivilegearray, 16)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineService/receive'; ?>">Service Item Receive</a>
                    <?php } if(menucheck($menuprivilegearray, 17)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineServicesCalendar'; ?>">Service Calendar</a>
                    <?php } ?>
                </nav>
            </div>
            <?php } ?>

            <!-- Machine Repairs -->
            <?php if(menucheck($menuprivilegearray, 18)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 text-dark" href="<?php echo base_url().'MachineRepairRequests'; ?>">
                <div class="nav-link-icon"><i class="fas fa-tools"></i></div>
                Machine Repairs
            </a>
            <?php } ?>

            <!-- Purchase Order -->
            <?php if(menucheck($menuprivilegearray, 19)==1 | menucheck($menuprivilegearray, 20)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapsePurchaseOrder">
                <div class="nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                Purchase Order
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($controllermenu=="Newpurchaserequest" | $controllermenu=="Purchaseorder"){echo 'show';} ?>" id="collapsePurchaseOrder" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    <?php if(menucheck($menuprivilegearray, 19)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Newpurchaserequest'; ?>">New Purchase Request</a>
                    <?php } if(menucheck($menuprivilegearray, 20)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Purchaseorder'; ?>">Purchase Order</a>
                    <?php } ?>
                </nav>
            </div>
            <?php } ?>

            <!-- GRN Section -->
            <?php if(menucheck($menuprivilegearray, 21)==1 | menucheck($menuprivilegearray, 22)==1 | menucheck($menuprivilegearray, 23)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseGRN">
                <div class="nav-link-icon"><i class="fas fa-warehouse"></i></div>
                GRN Section
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($controllermenu=="Goodreceive" | $controllermenu=="GRNVoucher" | $controllermenu=="GRNReturn"){echo 'show';} ?>" id="collapseGRN" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    <?php if(menucheck($menuprivilegearray, 21)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Goodreceive'; ?>">Good Receive Note</a>
                    <?php } ?>
                </nav>
            </div>
            <?php } ?>

            <!-- CRM -->
            <?php if(menucheck($menuprivilegearray, 24)==1 | menucheck($menuprivilegearray, 25)==1 | menucheck($menuprivilegearray, 26)==1 | menucheck($menuprivilegearray, 27)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseCRM">
                <div class="nav-link-icon"><i class="fas fa-handshake"></i></div>
                CRM
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($controllermenu=="CRMInquiry" | $controllermenu=="CRMQuotation" | $controllermenu=="CRMQuotationStatus" | $controllermenu=="CRMReason"){echo 'show';} ?>" id="collapseCRM" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    <?php if(menucheck($menuprivilegearray, 24)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'CRMInquiry'; ?>">CRM Inquiry</a>
                    <?php } if(menucheck($menuprivilegearray, 25)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'CRMQuotation'; ?>">CRM Quotation</a>
                    <?php } if(menucheck($menuprivilegearray, 26)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'CRMQuotationStatus'; ?>">CRM Quotation Status</a>
                    <?php } if(menucheck($menuprivilegearray, 27)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'CRMReason'; ?>">CRM Reason</a>
                    <?php } ?>
                </nav>
            </div>
            <?php } ?>

            <!-- CRM Order -->
            <?php if(menucheck($menuprivilegearray, 28)==1 | menucheck($menuprivilegearray, 29)==1 | menucheck($menuprivilegearray, 30)==1 | menucheck($menuprivilegearray, 31)==1 | menucheck($menuprivilegearray, 32)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseCRMOrder">
                <div class="nav-link-icon"><i class="fas fa-truck"></i></div>
                CRM Order
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($controllermenu=="CRMOrderdetail" | $controllermenu=="CRMDeliverydetail" | $controllermenu=="CRMCompletedorder" | $controllermenu=="Machinealloction" | $controllermenu=="AllocatedMachines"){echo 'show';} ?>" id="collapseCRMOrder" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    <?php if(menucheck($menuprivilegearray, 28)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'CRMOrderdetail'; ?>">CRM Order</a>
                    <?php } if(menucheck($menuprivilegearray, 29)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'CRMDeliverydetail'; ?>">Delivery Detail</a>
                    <?php } if(menucheck($menuprivilegearray, 30)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'CRMCompletedorder'; ?>">Completed Order</a>
                    <?php } if(menucheck($menuprivilegearray, 31)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Machinealloction'; ?>">Machine Allocation</a>
                    <?php } if(menucheck($menuprivilegearray, 32)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'AllocatedMachines'; ?>">Allocated Machines</a>
                    <?php } ?>
                </nav>
            </div>
            <?php } ?>

            <!-- Reports -->
            <?php if(menucheck($menuprivilegearray, 33)==1 | menucheck($menuprivilegearray, 34)==1 | menucheck($menuprivilegearray, 35)==1 | menucheck($menuprivilegearray, 36)==1 | menucheck($menuprivilegearray, 37)==1 | menucheck($menuprivilegearray, 38)==1 | menucheck($menuprivilegearray, 39)==1 | menucheck($menuprivilegearray, 40)==1 | menucheck($menuprivilegearray, 41)==1 | menucheck($menuprivilegearray, 42)==1 | menucheck($menuprivilegearray, 43)==1 | menucheck($menuprivilegearray, 44)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseReports">
                <div class="nav-link-icon"><i class="fas fa-chart-bar"></i></div>
                Reports
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($controllermenu=="Stock" | $controllermenu=="Goodreceive" | $controllermenu=="Servicecreatedlist" | $controllermenu=="Employeeservices" | $controllermenu=="Servicecostanalysis" | $controllermenu=="Usedserviceitems" | $controllermenu=="Repaircreatedlist" | $controllermenu=="MachineRepairsEmployee" | $controllermenu=="MachineRepairsCostAnalysis" | $controllermenu=="UsedRepairItems" | $controllermenu=="MachineWIP" | $controllermenu=="CustomerPOWIP"){echo 'show';} ?>" id="collapseReports" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    <?php if(menucheck($menuprivilegearray, 33)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Stock'; ?>">Stock</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 34)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Goodreceive'; ?>">GRN</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 35)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Servicecreatedlist'; ?>">Service Created List</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 36)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Employeeservices'; ?>">Employee Services</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 37)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Servicecostanalysis'; ?>">Service Cost Analysis</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 38)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Usedserviceitems'; ?>">Used Service Items</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 39)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'Repaircreatedlist'; ?>">Repair Created List</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 40)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineRepairsEmployee'; ?>">Employee Repairs</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 41)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineRepairsCostAnalysis'; ?>">Repair Cost Analysis</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 42)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'UsedRepairItems'; ?>">Used Repair Items</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 43)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineWIP'; ?>">Machine WIP</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 44)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'CustomerPOWIP'; ?>">Customer PO WIP</a><?php } ?>
                </nav>
            </div>
            <?php } ?>

            <!-- Return -->
            <?php if(menucheck($menuprivilegearray, 45)==1 | menucheck($menuprivilegearray, 46)==1 | menucheck($menuprivilegearray, 47)==1 | menucheck($menuprivilegearray, 48)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseReturn">
                <div class="nav-link-icon"><i class="fas fa-undo-alt"></i></div>
                Return
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($controllermenu=="return_to_stock" | $controllermenu=="return_accept" | $controllermenu=="return_to_supplier" | $controllermenu=="return_to_supplier_approve_front"){echo 'show';} ?>" id="collapseReturn" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav">
                    <?php if(menucheck($menuprivilegearray, 45)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineService/return_to_stock'; ?>">Return to Stock</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 46)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineService/return_accept'; ?>">Accepted Return Items</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 47)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineService/return_to_supplier'; ?>">Return to Supplier</a><?php } ?>
                    <?php if(menucheck($menuprivilegearray, 48)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'MachineService/return_to_supplier_approve_front'; ?>">Return to Supplier Approve</a><?php } ?>
                </nav>
            </div>
            <?php } ?>

            <?php if(menucheck($menuprivilegearray, 49)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 text-dark" href="<?php echo base_url().'Customer'; ?>">
                <div class="nav-link-icon"><i class="fas fa-user-friends"></i></div>
                Customer Info
            </a>
            <?php } ?>

            <?php if(menucheck($menuprivilegearray, 50)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 text-dark" href="<?php echo base_url().'Supplier'; ?>">
                <div class="nav-link-icon"><i class="fas fa-industry"></i></div>
                Supplier Info
            </a>
            <?php } ?>

            <?php if(menucheck($menuprivilegearray, 1)==1 | menucheck($menuprivilegearray, 2)==1 | menucheck($menuprivilegearray, 3)==1){ ?>
            <a class="nav-link p-0 px-3 py-2 collapsed text-dark" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                <div class="nav-link-icon"><i class="fas fa-user"></i></div>
                User Account
                <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($functionmenu=="Useraccount" | $functionmenu=="Usertype" | $functionmenu=="Userprivilege"){echo 'show';} ?>" id="collapseUser" data-parent="#accordionSidenav">
                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                    <?php if(menucheck($menuprivilegearray, 1)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'User/Useraccount'; ?>">User Account</a>
                    <?php } if(menucheck($menuprivilegearray, 2)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'User/Usertype'; ?>">Type</a>
                    <?php } if(menucheck($menuprivilegearray, 3)==1){ ?>
                    <a class="nav-link p-0 px-3 py-1 text-dark" href="<?php echo base_url().'User/Userprivilege'; ?>">Privilege</a>
                    <?php } ?>
                </nav>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title"><?php echo ucfirst($_SESSION['name']); ?></div>
        </div>
    </div>
</nav>
