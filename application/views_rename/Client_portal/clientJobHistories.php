<?php include('header.php');?>
<?php
	date_default_timezone_set('Europe/London');
	$current_date =  date('d-m-Y'); // Example output: 16-04-2025
?>
<style>
ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #ffe9e0;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #f65d1f;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}

.date_format{
    float: right !important;
    margin-right: 30px;
    color: #626262;
}
.history li.nav-item{
    padding: 0px;
}
.download .fas {
    background: #f65c21;
    color: #fff;
    padding: 5px;
    border-radius: 100px;
    font-size: 12px;
}

</style>

<?php include('navigation.php');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="page-content">
  <!-- Breadcrumb -->
  <div class="container">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Job History </li>
    </ol>
  </div>
   <!-- Dashboard Header -->
		<div class="container history">
			<div class="dashboard-tab-wrapper mb-3 py-2">
			    <div class="dashboard-tab">Client's Job History</div>
			    <div class="dashboard-line"></div>
			</div>

            <div class="card p-3">
                   <h4>Job Title: <?php echo generate_job_title_from_code($job->jobcode); ?></h4>
            </div>


			<div class="card  mt-3 bg-white">
	            <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tabs-live-tab" data-toggle="tab" data-type="live" href="#tabs-live" role="tab" aria-controls="tabs-live" aria-selected="true">Job History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tabs-hold-tab" data-toggle="tab" data-type="hold" href="#tabs-hold" role="tab" aria-controls="tabs-hold" aria-selected="false">Attachment & Comments</a>
                    </li>
                </ul>
                <div class="tab-content" id="tabs-tabContent">
                    <div class="tab-pane fade show active" id="tabs-live" role="tabpanel">
                        <ul class="timeline">
                            <?php foreach($job_notifications as $note):  
                                $badeg_note=(object) get_job_status_details($note->n_status);
                                ?>
                             <li>
                                <span class="badge <?php echo $badeg_note->badge_color; ?>"><?php echo $badeg_note->status; ?></span>
                                <small class="text-muted ml-2">(<?php echo $badeg_note->sub_status; ?>)</small>
                                <a href="#" class="float-right date_format">
                                    <?= date('d M, Y h:m:s', strtotime($note->created_at)) ?>
                                </a>
                                <!-- <p><?= nl2br(htmlspecialchars($note->message)) ?></p> -->
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tabs-hold" role="tabpanel">
                        <ul class="timeline">
                            <?php foreach($job_attachments as $ja): 
                                // Get file path, file name and type
                                $file_path = $ja->file_path;
                                $file_name = basename($file_path);
                                $file_type = pathinfo($file_path, PATHINFO_EXTENSION);
                                $file_size = $ja->file_size?$ja->file_size:0;
                                $created_at = $ja->created_at;
                    
                                // Assume you have a helper for badge (optional)
                                $badge_note = get_job_status_details($ja->n_status ?? ''); 
                            ?>
                            <li>
                                <span class="badge <?= $badge_note['badge_color'] ?? 'badge-secondary' ?>">
                                    <?= strtoupper($file_type) ?> File
                                </span>
                                <small class="text-muted ml-2">(<?= $badge_note['sub_status'] ?? 'Uploaded' ?>)</small>
                    
                                <a href="<?= base_url($file_path) ?>" target="_blank" class="float-right date_format">
                                    <?= date('d M, Y h:i:s', strtotime($created_at)) ?>
                                </a>
                    
                    
                                <?php
                      $extension = pathinfo($file_path, PATHINFO_EXTENSION);
                    $icon = 'fa-file'; // default
                    
                    switch (strtolower($extension)) {
                        case 'pdf':
                            $icon = 'fa-file-pdf text-danger';
                            break;
                        case 'doc':
                        case 'docx':
                            $icon = 'fa-file-word text-primary';
                            break;
                        case 'xls':
                        case 'xlsx':
                            $icon = 'fa-file-excel text-success';
                            break;
                        case 'png':
                        case 'jpg':
                        case 'jpeg':
                            $icon = 'fa-file-image text-warning';
                            break;
                        case 'zip':
                        case 'rar':
                            $icon = 'fa-file-archive text-secondary';
                            break;
                        case 'txt':
                            $icon = 'fa-file-alt';
                            break;
                    }
                    ?>
                    
                     <i class="fas <?= $icon ?>"></i>
                    
                                <p>
                                    <strong>File:</strong> <?= htmlspecialchars($file_name) ?>
                                    <a href="<?=base_url($file_path) ?>" download class="download">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <br>
                                    <strong>Size:</strong> 
                                    <?= is_numeric($file_size) ? round($file_size / 1024, 2) . ' KB' : 'Unknown size' ?>
                                </p>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>


			</div>
		</div>
	</div>
</div>	

<!--EndPreview Modal-->

<?php include('footer.php');?>
