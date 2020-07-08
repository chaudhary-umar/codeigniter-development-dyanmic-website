<li class="list-group-item single-department" data-id="<?php echo $department->getId();?>" id="row-department-<?php echo $department->getId();?>">
    <div class="row pr-3">
        <div class="col-md-10"><h4><?php echo $department->getDepartmentName();?></h4></div>
        <div class="col-md-2 text-right" style="padding-top:0.9em">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-secondary btn-sm" data-toggle="collapse" href="#departmentDetail<?php echo $department->getId();?>" title="See Details"><i class="fa fa-fw fa-eye"></i></button>
                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-for="department" data-target="#deleteConfirmationModal" title="Delete"><i class="fa fa-fw fa-trash"></i></button>
            </div>
        </div>
    </div>
    <div class="collapse" id="departmentDetail<?php echo $department->getId();?>">
        <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
                <div class="card mt-2">
                    <div class="card-header row">
                    <div class="col-md-10">
                    <span class="h4">Services</span>
                    </div>
                    <div class="col-md-2 text-right">
                        <button title="Add service to the department" class="btn btn-primary btn-sm edit" data-for="services">
                            <i class="fa fa-fw fa-plus"></i>
                        </button>
                    </div>
                    </div>
                    <div class="card-body services-list alternate-grid" style="margin-top:5px">
                    <?php 
                    $class='';
                    $query = $this->doctrine->em->createQueryBuilder()
                                 ->select('c')
                                 ->from('GptHospitalServiceXref', 'c')
                                 ->join('c.hospital', 'h', 'WITH', 'h.hospitalId = ?1')
                                 ->join('c.department', 's', 'WITH', 's.hospitalDeptId = ?2')
                                 ->setParameter(1, $hospital->getId())
                                 ->setParameter(2, $department->getId())
                                 ->getQuery();
                        $services = $query->getResult();
                        if($services && count($services)){
                            $class='d-none';
                             foreach($services as $service){
                                $this->load->view('myaccount/hospital/partials/display-service',['service'=>$service]);
                            }
                        }
                        ?>
                        <div class="not-found <?php echo $class;?>">No service found. Click "+" above to attach.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <div class="card mt-2">
                <div class="card-header row">
                    <div class="col-md-10">
                    <span class="h4">Contacts</span>
                    </div>
                    <div class="col-md-2 text-right">
                        <button title="Add contact to the department" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#contactAddModal">
                            <i class="fa fa-fw fa-plus"></i>
                        </button>
                    </div>
                    </div>
                    <div class="card-body contacts-list" style="margin-top:5px">
                        <?php 
                        $class='';
                        $query = $this->doctrine->em->createQueryBuilder()
                                 ->select('c')
                                 ->from('GptHospitalContXref', 'c')
                                 ->join('c.hospital', 'h', 'WITH', 'h.hospitalId = ?1')
                                 ->join('c.hospitalDept', 'd', 'WITH', 'd.hospitalDeptId = ?2')
                                 ->setParameter(1, $hospital->getId())
                                 ->setParameter(2, $department->getId())
                                 ->getQuery();
                        $xrefs = $query->getResult();
                        if($xrefs && count($xrefs)){
                            $class='d-none';
                             foreach($xrefs as $xref){
                                $this->load->view('myaccount/hospital/partials/display-contact',['xref'=> $xref]);
                            }
                        }
                        ?>
                        <div class="not-found <?php echo $class;?>">No department contact found. Click "+" above to attach.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>