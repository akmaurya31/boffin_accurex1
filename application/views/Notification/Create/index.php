<style>
.select2-results__option {
  position: relative;
  padding-left: 30px !important;
}
.select2-results__option::before {
  content: "";
  position: absolute;
  left: 8px;
  top: 50%;
  transform: translateY(-50%);
  height: 16px;
  width: 16px;
  border: 2px solid #aaa;
  background-color: #fff;
  border-radius: 3px;
}
.select2-results__option[aria-selected="true"]::before {
  background-color: #007bff;
  border-color: #007bff;
}
form label{
    display: block;
    font-weight: 900;
}
.custom-control-input{
    opacity: 1;
    position: relative;
    z-index: 1;
}
.b-t-1{
    border-top:1px solid lightgray;
}
.select2-search__field{
    padding: 0px 5px !important;
}
</style>

<div class="row">
    <div class="col-sm-12">
        <?php if(!$edit){
            $heading        =  "Create";
            $backBtnUrl     =  "Activities";
            $backBtnTxt     =  "Notification";
            $formURL        =  "send-notification";
        }else{
            $heading        =  'Edit';
            $backBtnUrl     =  "sent-notifications";
            $backBtnTxt     =  'Sent List';
            $formURL        =  "update-notification";
        }
        ?>
        
        <h4 class="page-title"><?php echo $heading;?> Notification</h4>
    </div>
</div>

<!-- getUsersListByNotificationID($id) -->

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <form action="<?php echo base_url($formURL);?>" method="POST" enctype="multipart/form-data">
                <a href="<?php echo base_url($backBtnUrl);?>" class="btn-navy" type="button"> 
                    <i class="fa fa-arrow-left m-l-5"></i> <span>Back To <?php echo $backBtnTxt;?></span>
                </a>
                <div class="form-group mt-2 b-t-1 pt-4">
                    <label for="to">To</label>
                    <select class="form-control" id="recipients" name="recipients[]" multiple>
                        <?php
                            if(!empty($users)){
                                if(!$edit){
                                    foreach($users as $user){?>
                                    <option value="<?php echo $user->user_ID;?>"><?php echo $user->full_name;?></option>
                        <?php
                                }}else{
                                    $usersListRaw   = $this->user_lib->getUsersListByNotificationID($edit[0]->notification_ID);
                                    $usersList      = array_map(function($u) { return $u->user_ID; }, $usersListRaw);
                                    foreach($users as $user){?>
                                        <option value="<?php echo $user->user_ID; ?>" <?= in_array($user->user_ID, $usersList) ? 'selected' : ''; ?>>
                                            <?php echo $user->full_name; ?>
                                        </option>

                        <?php
                                }}
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" placeholder="title" class="form-control" name="title" value="<?= $edit ? $edit[0]->title : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea rows="4" cols="5" class="form-control summernote"
                        placeholder="Enter your message here" name="description"><?= $edit ? $edit[0]->description : ''; ?></textarea>
                </div>
                <div class="form-group mb-0">
                    <div class="text-center compose-btn">
                        <?= $edit ? "<input type='hidden' name='notification_ID' value='".$edit[0]->notification_ID."'>" : ''; ?>
                        <button class="btn btn-primary"><i class="fa fa-send m-l-5"></i> <span>Send Notification</span> </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>