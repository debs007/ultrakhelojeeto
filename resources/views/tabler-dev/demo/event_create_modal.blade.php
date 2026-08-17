<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.createEvent')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Event name</label>
              <input type="text" class="form-control" name="event_name" placeholder="Enter event name" required>
            </div>
            <label class="form-label">Event type</label>
            <div class="form-selectgroup-boxes row mb-3">
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input type="radio" name="event_type" value="Social" class="form-selectgroup-input" checked>
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Social</span>
                      <span class="d-block text-secondary">This event type specifies all social events, including National events as well</span>
                    </span>
                  </span>
                </label>
              </div>
              <div class="col-lg-6">
                <label class="form-selectgroup-item">
                  <input type="radio" name="event_type" value="Personal" class="form-selectgroup-input">
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Personal</span>
                      <span class="d-block text-secondary">This event type is for personal events related to club members or any other authorised person</span>
                    </span>
                  </span>
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
              <div class="mb-3">
                            <div class="form-label">Choose event banner</div>
                            <input type="file" name="event_banner" class="form-control" accept="image/png, image/jpeg, image/jpg">
                          </div>
              </div>
              <div class="col-lg-6">
              <div class="mb-3">
                            <div class="form-label">Event venue</div>
                            <input type="text" name="event_venue" class="form-control" value="Lion's club" required>
                          </div>
              </div>
              
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-4">
              <div class="mb-3">
                              <div class="form-label">Select host 1</div>
                              <select class="form-select" name="host1" required>
                                <option>None</option>
                                @foreach($allActivs as $au)
                                <option value="{{$au->id}}">{{$au->name}}</option>
                                @endforeach
                                
                                
                              </select>
                            </div>
              </div>
              <div class="col-lg-4">
              <div class="mb-3">
                              <div class="form-label">Select host 2</div>
                              <select class="form-select" name="host2">
                              <option>None</option>
                                @foreach($allActivs as $au)
                                <option value="{{$au->id}}">{{$au->name}}</option>
                                @endforeach
                                
                                
                              </select>
                            </div>
              </div>
              <div class="col-lg-4">
              <div class="mb-3">
                              <div class="form-label">Select host 3</div>
                              
                              <select class="form-select" name="host3">
                              <option>None</option>
                                @foreach($allActivs as $au)
                                <option value="{{$au->id}}">{{$au->name}}</option>
                                @endforeach
                                
                              </select>
                            </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Start date</label>
                  <input type="date" name="start_date" class="form-control" required>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">End date</label>
                  <input type="date" name="end_date" class="form-control" required>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <label class="form-label">Event information</label>
                  <textarea class="form-control" name="desc" rows="3" required></textarea>
                </div>
              </div>
              <div class="col-lg-6">
              <div class="mb-3">
                                <label class="row">
                                  <span class="col">WhatsApp Notification</span>
                                  <span class="col-auto">
                                    <label class="form-check form-check-single form-switch">
                                      <input class="form-check-input" type="checkbox" name="whatsapp" value="1">
                                    </label>
                                  </span>
                                </label>
                                </div>
                              
              </div>
              <div class="col-lg-6">
              <div class="mb-3">
                                <label class="row">
                                  <span class="col">In app Notification</span>
                                  <span class="col-auto">
                                    <label class="form-check form-check-single form-switch">
                                      <input class="form-check-input" type="checkbox" name="inapp" value="1">
                                    </label>
                                  </span>
                                </label>
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
              Create new event
</button>
          </div>
        </div>
</form>
      </div>
    </div>

    <div class="modal modal-blur fade" id="modal-success" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-status bg-success"></div>
          <div class="modal-body text-center py-4">
            <!-- Download SVG icon from http://tabler-icons.io/i/circle-check -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-green icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 12l2 2l4 -4" /></svg>
            <h3 id="nt">Event created</h3>
            <div id="nm" class="text-secondary">Event created successfully. View your event in upcoming event section.</div>
          </div>
          <div class="modal-footer">
            <div class="w-100">
              <div class="row">
                <div class="col"><a href="#" class="btn btn-success w-100" data-bs-dismiss="modal">
                    Alright
                  </a></div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- notification modal -->
    <div class="modal modal-blur fade" id="modal-notification" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="notification_form" method="post" action="{{route('webconnect.sendNotification')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New notification</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Notification name</label>
              <input type="text" class="form-control" name="title" placeholder="Enter notification title" required>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-lg-12">
                <div class="mb-3">
                            <label class="form-label">Send to</label>
                            <select type="text" class="form-select" id="select-people" value="" name="id" required>
                              <option value="all">All</option>
                                @foreach($allActivs as $usr)
                                <option value='{{$usr->id}}' data-custom-properties="&lt;span class=&quot;avatar avatar-xs&quot; style=&quot;background-image: url('{{$usr->profilePicture}}')&quot;&gt;&lt;/span&gt;">{{$usr->name}}</option>
                                @endforeach
                              
                            </select>
                            <p style="position: relative;"></p>
                          </div>
                </div>
              
              
              
              <div class="col-lg-12">
                <div class="mb-3">
                  <label class="form-label">Notification details</label>
                  <textarea class="form-control" name="notification" rows="3" required></textarea>
                </div>
              </div>
              <div class="col-lg-6">
              <div class="mb-3">
                                <label class="row">
                                  <span class="col">WhatsApp Notification</span>
                                  <span class="col-auto">
                                    <label class="form-check form-check-single form-switch">
                                      <input class="form-check-input" type="checkbox" name="whatsapp" value="1">
                                    </label>
                                  </span>
                                </label>
                                </div>
                              
              </div>
              <div class="col-lg-6">
              <div class="mb-3">
                                <label class="row">
                                  <span class="col">In app Notification</span>
                                  <span class="col-auto">
                                    <label class="form-check form-check-single form-switch">
                                      <input class="form-check-input" type="checkbox" name="inapp" value="1">
                                    </label>
                                  </span>
                                </label>
                                </div>
                              
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-success ms-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-code" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"></path>
   <path d="M3 7l9 6l9 -6"></path>
   <path d="M20 21l2 -2l-2 -2"></path>
   <path d="M17 17l-2 2l2 2"></path>
</svg>
              Send a notification
</button>
          </div>
        </div>
</form>
      </div>
    </div>
    <!-- notifcation end -->


    