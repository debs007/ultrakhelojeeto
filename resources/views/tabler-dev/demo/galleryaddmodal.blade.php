<div class="modal modal-blur fade" id="modal-gallery" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.createGallery')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Upload gallery</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          @php
        use App\Models\Event;
        $event = Event::select("*")->get();
          @endphp
          <div class="modal-body">
            <div class="row">
            <div class="col-lg-12">
              <div class="mb-3">
                              <div class="form-label">Select event</div>
                              <select class="form-select" name="event_id" required>
                                
                                @foreach($event as $au)
                                <option value="{{$au->id}}">{{$au->name}}</option>
                                @endforeach
                                
                                
                              </select>
                            </div>
              </div>
            <div class="col-lg-6">
              <div class="mb-3">
                            <div class="form-label">Choose photos zip</div>
                            <input type="file" name="photoZip" class="form-control" accept=".zip">
                          </div>
              </div>
              <div class="col-lg-6">
              <div class="mb-3">
                            <div class="form-label">Choose videos zip</div>
                            <input type="file" name="videoZip" class="form-control" accept=".zip">
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
              Upload to gallery
</button>
          </div>
        </div>
</form>
      </div>
    </div>