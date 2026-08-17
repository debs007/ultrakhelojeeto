<!-- Modal new user -->
<div class="modal modal-blur fade" id="modal-user" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.createUser')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">New Agent</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Agent name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter member's name" autocomplete="off" value="" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Choose a password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter a password" autocomplete="off" value="" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Commision Percent</label>
              <input type="number" class="form-control" name="percent" placeholder="Enter commision percentage" autocomplete="off" value="" required>
            </div>
            <input type="hidden" name="type" value="agent" />
          </div>
          <div class="modal-body">
            <div class="row">
              
              @php
              use App\Models\User;

              if(Session::has('super'))
              {
                $professions = User::where('stockist',Session::get('super'))->get();
              }

              else if(Session::has('stk')){
                $professions = User::where('name',Session::get('stk'))->get();
                }
              else{
                $professions = User::where('type','stockist')->orderBy('name','asc')->get();
                }
              @endphp
              <div class="col-lg-12">
                <div class="mb-3" id="professionSelect">
                <div class="form-label" id="profLable">Select Stockist</div>
                              
                              <select class="form-select" name="stockist" id="profs" required>
                              
                                @foreach($professions as $pf)
                                <option value="{{$pf->name}}">{{$pf->name}}</option>
                                @endforeach
                                
                              </select>
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
              Create New Agent
</button>
          </div>
        </div>
</form>
      </div>
    </div>
    <!-- End new user -->
<!-- User Edit -->
<div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.editUser')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Agent</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Agent name</label>
              <input type="text" class="form-control" name="name" id="editName" placeholder="Enter member's name" autocomplete="off" value="" required>
            </div>
            
            <div class="mb-3">
              <label class="form-label">Commision Percent</label>
              <input type="number" class="form-control" name="percent" id="editPercent" placeholder="Enter commision percentage" autocomplete="off" value="" required>
            </div>
            <input type="hidden" name="type" value="agent" />
          </div>
          
          
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Cancel
            </a>
            <button type="submit" class="btn btn-primary ms-auto">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
              Edit Agent
</button>
          </div>
        </div>
</form>
      </div>
    </div>
<!-- end edit -->
    