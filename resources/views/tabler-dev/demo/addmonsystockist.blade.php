<!-- Modal new user -->
<div class="modal modal-blur fade" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.addMoney')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" value="" id="moneyid" name="token" />
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Money</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Amount</label>
              <input type="text" class="form-control" name="amount" placeholder="Enter amount to add" autocomplete="off" value="" required>
            </div>
            
            
          </div>
          
          
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-primary ms-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-puzzle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7h3a1 1 0 0 0 1 -1v-1a2 2 0 0 1 4 0v1a1 1 0 0 0 1 1h3a1 1 0 0 1 1 1v3a1 1 0 0 0 1 1h1a2 2 0 0 1 0 4h-1a1 1 0 0 0 -1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-1a2 2 0 0 0 -4 0v1a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h1a2 2 0 0 0 0 -4h-1a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1" /></svg>
              Add Money
</button>
          </div>
        </div>
</form>
      </div>
    </div>
    <!-- End new user -->
    <!--BlockUser-->
    <div class="modal modal-blur fade" id="modal-block" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.blockUser')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" value="" id="blockId" name="token" />
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Block Stockist</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Reason</label>
              <input type="text" class="form-control" name="reason" placeholder="Enter reason to block" autocomplete="off" value="" required>
            </div>
            
            
          </div>
          
          
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-warning ms-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M5.7 5.7l12.6 12.6" /></svg>
              Block Stockist
</button>
          </div>
        </div>
</form>
      </div>
    </div>
    <!-- end block-->

    <div class="modal modal-blur fade" id="modal-withdraw" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.withdrawMoney')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" value="" id="moneyid_n" name="token" />
        
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Withdraw Money</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Amount</label>
              <input type="text" class="form-control" name="amount" placeholder="Enter amount to withdraw" autocomplete="off" value="" required>
            </div>
            
            
          </div>
          
          
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-warning ms-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-puzzle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7h3a1 1 0 0 0 1 -1v-1a2 2 0 0 1 4 0v1a1 1 0 0 0 1 1h3a1 1 0 0 1 1 1v3a1 1 0 0 0 1 1h1a2 2 0 0 1 0 4h-1a1 1 0 0 0 -1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-1a2 2 0 0 0 -4 0v1a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h1a2 2 0 0 0 0 -4h-1a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1" /></svg>
              Withdraw Money
</button>
          </div>
        </div>
</form>
      </div>
    </div>

    