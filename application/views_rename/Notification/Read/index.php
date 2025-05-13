<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <!-- Notification Card -->
      <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4">

          <!-- Header with user image and name -->
          <div class="d-flex align-items-center mb-4 underline-card">
            <img src="<?php echo base_url('upload/'.$notification[0]->image); ?>"
                 alt="User Image"
                 class="rounded-circle border shadow-sm me-3"
                 width="64" height="64" style="margin-right: 15px;">
            <div>
                <h5 class="mb-1"><?php echo $notification[0]->full_name; ?></h5>
                <small class="text-muted"><?php echo $notification[0]->email; ?></small>
                <small class="text-muted" style="display: block;">
                    <?php echo $this->user_lib->timeAgo($notification[0]->created_on); ?>
                </small>
            </div>
          </div>

          <!-- Notification content -->
          <h4 class="fw-bold text-dark mb-3"><?php echo $notification[0]->title; ?></h4>
          <p class="text-secondary fs-6"><?php echo $notification[0]->description; ?></p>

          <!-- Divider -->
          <hr class="my-4">

          <!-- Notification Meta -->
          <div class="row text-muted small">

            <div class="col-md-12">
                <a href="<?php echo base_url('activities'); ?>" class="btn btn-outline-primary rounded-pill">
                ← Back to Notifications
                </a>
            </div>

            <!-- <div class="col-md-6 mb-2">
              <strong>Status:</strong>
              <?php if (strtolower($notification[0]->status) === 'seen'): ?>
                <span class="badge bg-success">Seen</span>
              <?php else: ?>
                <span class="badge bg-warning text-dark">Unread</span>
              <?php endif; ?>
            </div> -->
            <!-- <div class="col-md-6 mb-2">
              <strong>Created On:</strong> <?php echo $notification[0]->created_on; ?>
            </div>
            <div class="col-md-6 mb-2">
              <strong>Notification ID:</strong> <?php echo $notification[0]->notification_ID; ?>
            </div>
            <div class="col-md-6 mb-2">
              <strong>Recipient User ID:</strong> <?php echo $notification[0]->recepient_user_ID; ?>
            </div>
            <div class="col-md-6 mb-2">
              <strong>Forwarded By (User ID):</strong> <?php echo $notification[0]->forworded_user_ID; ?>
            </div> -->
          </div>

          <!-- Back Button -->
          <!-- <div class="mt-4">
            <a href="<?php echo base_url('notification'); ?>" class="btn btn-outline-primary rounded-pill">
              ← Back to Notifications
            </a>
          </div> -->

        </div>
      </div>

    </div>
  </div>
</div>
