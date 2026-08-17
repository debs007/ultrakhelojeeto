<div class="modal modal-blur fade" id="modal-ads" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.createAd')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create ad</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          
          
          <div class="modal-body">
            <div class="row">
                
            <div class="col-lg-12">
            <div class="mb-3">
              <label class="form-label">Website link (optional)</label>
              <input type="text" class="form-control" name="link" placeholder="Enter website link or any url where the add will redirect">
            </div>
              </div>
            <div class="col-lg-6">
              <div class="mb-3">
                            <div class="form-label">Choose ad banner</div>
                            <input type="file" name="ad_image" class="form-control" accept=".png, .jpg" required>
                          </div>
              </div>
              <div class="col-lg-6">
              <div class="mb-3">
                            <div class="form-label">Enter phone number to display(optional)</div>
                            <input type="text" class="form-control" name="phone" placeholder="Enter phone number">
                          </div>
              </div>
              <div class="col-lg-12">
              <div class="mb-3">
                            <div class="form-label">Enter email address to display(optional)</div>
                            <input type="text" class="form-control" name="email" placeholder="Enter email address">
                          </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                            <label class="form-label">Select members</label>
                            <select type="text" class="form-select" id="select-people" value="" name="id" required>
                              
                                @foreach($user as $usr)
                                <option value='{{$usr->id}}' data-custom-properties="&lt;span class=&quot;avatar avatar-xs&quot; style=&quot;background-image: url('{{$usr->profilePicture}}')&quot;&gt;&lt;/span&gt;">{{$usr->name}}</option>
                                @endforeach
                              
                              
                            </select>
                            <p style="position: relative;"></p>
                          </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-primary ms-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Create Ad
</button>
          </div>
        </div>
</form>
      </div>
    </div>