<style>
    .nav-tab {
      background-color: #1f3556;
      color: white;
      padding: 10px 20px;
      font-weight: bold;
      border-top-left-radius: 5px;
      border-top-right-radius: 5px;
    }
    .card-title {
      font-weight: bold;
      font-size: 1.25rem;
    }
    .status-circle {
      height: 15px;
      width: 15px;
      background-color: #f75c1e;
      border-radius: 50%;
      display: inline-block;
      margin-right: 10px;
    }
    .badge-reviewed {
      background-color: #17a2b8;
      color: white;
      margin-right: 5px;
    }
    .footer-text {
      font-size: 0.9rem;
      color: #6c757d;
      margin-top: 40px;
    }
    .flex{
        display: flex;
    }
    .tab-content{
        padding: 0px;
    }
    .nav-tabs > li > a{
        color: #000 !important;
        font-weight: 300;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
        background-color: #fff !important;
    }
  </style>
<div class="container">
    
    <div class="nav-tab">
      Client's Job History
    </div>

    <div class="card border mt-0">
      <div class="card-body">
        <h5 class="card-title">Job Title: UTTAM KUMAR-OTH--(MP)</h5>
      </div>
    </div>

    <ul class="nav nav-tabs mt-3" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#history">Job History</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#attachments">Attachment & Comments</a>
      </li>
    </ul>

    <div class="tab-content">
      <div id="history" class="tab-pane fade show active">
        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="flex">
              <span class="status-circle"></span>
              <span class="badge badge-reviewed">Reviewed</span>
              <small class="text-muted">(Can be started)</small>
            </div>
            <div>
              <small class="text-muted">05 May, 2025 06:05:24</small>
            </div>
          </div>
        </div>
      </div>
      
      <div id="attachments" class="tab-pane fade">
          <div class="card">
            <div class="card-body">
        
              <!-- First Comment Block -->
              <div class="d-flex justify-content-between">
                <div>
                  <span class="status-circle"></span>
                  <span>adada as da da d</span>
                </div>
                <div class="text-muted">01 Jan, 1970 01:00:00</div>
              </div>
              <div class="mt-2 pl-4">
                <div class="mb-2">
                  <span class="badge badge-primary">PDF File</span>
                  <small class="text-muted ml-1">(Uploaded)</small>
                  <i class="fas fa-file-pdf text-danger ml-1"></i>
                  <div><strong>File:</strong> 1746714648_2025-04-25T07-02_Transaction_...151016.pdf</div>
                  <div><strong>Size:</strong> 1054.33 KB <a href="#" class="ml-2 text-danger"><i class="fas fa-download"></i></a></div>
                </div>
                <div class="mb-2">
                  <span class="badge badge-primary">PDF File</span>
                  <small class="text-muted ml-1">(Uploaded)</small>
                  <i class="fas fa-file-pdf text-danger ml-1"></i>
                  <div><strong>File:</strong> 1746714648_2025-04-25T07-02_Transaction_...151061.pdf</div>
                  <div><strong>Size:</strong> 33.26 KB <a href="#" class="ml-2 text-danger"><i class="fas fa-download"></i></a></div>
                </div>
              </div>
        
              <hr>
        
              <!-- Second Comment Block -->
              <div class="d-flex justify-content-between">
                <div>
                  <span class="status-circle"></span>
                  <span>helllo</span>
                </div>
                <div class="text-muted">08 May, 2025 02:30:48</div>
              </div>
              <div class="mt-2 pl-4">
                <div class="mb-2">
                  <span class="badge badge-warning">JPG File</span>
                  <small class="text-muted ml-1">(Uploaded)</small>
                  <i class="fas fa-file-image text-warning ml-1"></i>
                  <div><strong>File:</strong> 1746787197_Leonardo_..._con_1.jpg</div>
                  <div><strong>Size:</strong> 678.48 KB <a href="#" class="ml-2 text-danger"><i class="fas fa-download"></i></a></div>
                </div>
              </div>
        
            </div>
          </div>
        </div>
      
    </div>