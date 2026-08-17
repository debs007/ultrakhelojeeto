<!-- Modal update user -->
<div class="modal modal-blur fade" id="modal-updateuser" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.updateUser')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Member details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Member name</label>
              <input type="text" class="form-control" name="member_name" placeholder="Enter member's name" value="{{$name}}" required>
            </div>
            <!-- <div class="mb-3">
              <label class="form-label">Choose a password</label>
              <input type="password" class="form-control" name="member_pass" placeholder="Enter a password" required>
            </div> -->
            <input type="hidden" name="token" value="{{$token}}">
            <div class="mb-3">
              <label class="form-label">Member phone number</label>
              <input type="text" class="form-control" name="member_phone"  placeholder="Enter member's phone number" value="{{$phone}}" maxlength="10" required>
            </div>
            <label class="form-label">Member type</label>
            <div class="form-selectgroup-boxes row mb-3">
              <div class="col-lg-3">
                <label class="form-selectgroup-item">
                  <input type="radio" name="member_type" value="president" class="form-selectgroup-input" @if($designation=="president") checked @endif>
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">President</span>
                      <span class="d-block text-secondary">For president</span>
                    </span>
                  </span>
                </label>
              </div>
              <div class="col-lg-3">
                <label class="form-selectgroup-item">
                  <input type="radio" name="member_type" value="vice president" class="form-selectgroup-input" @if($designation=="vice president") checked @endif>
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Treasurer</span>
                      <span class="d-block text-secondary">For treasurer</span>
                    </span>
                  </span>
                </label>
              </div>
              <div class="col-lg-3">
                <label class="form-selectgroup-item">
                  <input type="radio" name="member_type" value="secretary" class="form-selectgroup-input" @if($designation=="secretary") checked @endif>
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Secretary</span>
                      <span class="d-block text-secondary">For secretary</span>
                    </span>
                  </span>
                </label>
              </div>
              <div class="col-lg-3">
                <label class="form-selectgroup-item">
                  <input type="radio" name="member_type" value="member" class="form-selectgroup-input" @if($designation=="member") checked @endif>
                  <span class="form-selectgroup-label d-flex align-items-center p-3">
                    <span class="me-3">
                      <span class="form-selectgroup-check"></span>
                    </span>
                    <span class="form-selectgroup-label-content">
                      <span class="form-selectgroup-title strong mb-1">Member</span>
                      <span class="d-block text-secondary">For just member</span>
                    </span>
                  </span>
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
              <div class="mb-3">
                            <div class="form-label">Choose member profile picture (optional)</div>
                            <input type="file" name="profile_picture" class="form-control" accept="image/png, image/jpeg, image/jpg">
                          </div>
              </div>
              
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
              
              @php
              use App\Models\Profession;

              $professions = Profession::select('*')->get();
              @endphp
              <div class="col-lg-6">
                <div class="mb-3" id="professionSelect">
                <div class="form-label" id="profLable">Select profession</div>
                              
                              <select class="form-select" name="profession" onChange="CheckProfession()" id="profs" required>
                              <option>Select Profession</option>
                              <option>Other</option>
                                @foreach($professions as $pf)
                                @if($pf->name == $profession)
                                <option value="{{$pf->name}}" selected>{{$pf->name}}</option>
                                @else
                                <option value="{{$pf->name}}">{{$pf->name}}</option>
                                @endif
                                @endforeach
                                
                              </select>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">City</label>
                  <input type="text" name="city" class="form-control" value="{{$city}}" required>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">Zip</label>
                  <input type="text" name="zip" value="{{$zip}}" class="form-control" required>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">Blood Group</label>
                  <select class="form-select" name="blood" required>
                    @if($bloodGroup == "a+")
                    <option value="a+" selected>A+</option>
                    @elseif($bloodGroup == "b+")
                    <option value="b+" selected>B+</option>
                    @elseif($bloodGroup == "a-")
                    <option value="a-" selected>A-</option>
                    @elseif($bloodGroup == "b-")
                    <option value="b-" selected>B-</option>
                    @elseif($bloodGroup == "ab+")
                    <option value="ab+" selected>Ab+</option>
                    @elseif($bloodGroup == "ab-")
                    <option value="ab-" selected>Ab-</option>
                    @elseif($bloodGroup == "o+")
                    <option value="o+" selected>o+</option>
                    @elseif($bloodGroup == "o-")
                    <option value="o-" selected>o-</option>
                    @endif

                    <option value="a+">A+</option>
                    <option value="b+">B+</option>
                    <option value="a-">A-</option>
                    <option value="b-">B-</option>
                    <option value="ab+">Ab+</option>
                    <option value="ab-">Ab-</option>
                    <option value="o+">O+</option>
                    <option value="o-">O-</option>

                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-3">
                  
                  <label class="form-label">Anniversary (optional)</label>
                  <input type="date" name="anni" class="form-control" value="{{$aniversery}}">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-3">
                  
                  <label class="form-label">Date of Birth</label>
                  <input type="date" name="dob" class="form-control" value={{$dob}} required>
                </div>
              </div>
              
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Professional details (optional)</label>
                  <input type="text" name="professionDetails" value="{{$professionDetails}}" class="form-control">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Member's Qualification (optional)</label>
                  <input type="text" name="qualification" class="form-control" value="{{$qualification}}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Member's Email (optional)</label>
                  <input type="text" name="email" class="form-control" value="{{$email}}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Member's Year of joining (optional)</label>
                  <input type="text" name="yoj" class="form-control" value="{{$yoj}}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Member's residential address (optional)</label>
                  <input type="text" name="address" class="form-control" value="{{$address}}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Member's office address (optional)</label>
                  <input type="text" name="officeAddress" class="form-control" value="{{$officeAddress}}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Highest post in Lionism (optional)</label>
                  <input type="text" name="highest" class="form-control" value="{{$highest}}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Passion (optional)</label>
                  <input type="text" name="passion" class="form-control" value="{{$passion}}">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-body">
          <div class="row">
          <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">Spouse name (optional)</label>
                  <input type="text" name="spouse" class="form-control" value="{{$spouse}}">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">Spouse profession (optional)</label>
                  <input type="text" name="spouseProfession" class="form-control" value="{{$spouseProfession}}">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">Spouse phone (optional)</label>
                  <input type="text" name="spousePhone" class="form-control" value="{{$spousePhone}}">
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-lg-6">
              <div class="mb-3">
                            <div class="form-label">Choose spouse profile picture (optional)</div>
                            <input type="file" name="spouse_profile" class="form-control" accept="image/png, image/jpeg, image/jpg">
                          </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  
                  <label class="form-label">Spouse Date of Birth (optional)</label>
                  <input type="date" name="spouseDob" class="form-control" value="{{$spouseDob}}">
                </div>
              </div>
            </div>
            <div class="row">
            
              <div class="col-lg-4">
                <div class="mb-3">
                  <label class="form-label">Spouse Blood Group (optional)</label>
                  <select class="form-select" name="spouseBlood">

                  @if($spouseBlood == "a+")
                    <option value="a+" selected>A+</option>
                    @elseif($spouseBlood == "b+")
                    <option value="b+" selected>B+</option>
                    @elseif($spouseBlood == "a-")
                    <option value="a-" selected>A-</option>
                    @elseif($spouseBlood == "b-")
                    <option value="b-" selected>B-</option>
                    @elseif($spouseBlood == "ab+")
                    <option value="ab+" selected>Ab+</option>
                    @elseif($spouseBlood == "ab-")
                    <option value="ab-" selected>Ab-</option>
                    @elseif($spouseBlood == "o+")
                    <option value="o+" selected>O+</option>
                    @elseif($spouseBlood == "o-")
                    <option value="o-" selected>O-</option>
                    @else
                    <option value="">Select</option>
                    @endif

                    
                    <option value="a+">A+</option>
                    <option value="b+">B+</option>
                    <option value="a-">A-</option>
                    <option value="b-">B-</option>
                    <option value="ab+">Ab+</option>
                    <option value="ab-">Ab-</option>
                    <option value="o+">O+</option>
                    <option value="o-">O-</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="mb-3">
                  
                  <label class="form-label">Spouse Passion (optional)</label>
                  <input type="text" name="spousePassion" class="form-control" value="{{$spousePassion}}">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="mb-3">
                  
                  <label class="form-label">Spouse Highest Post (optional)</label>
                  <input type="text" name="spouseHighest" class="form-control" value="{{$spouseHighest}}">
                </div>
              </div>
              
            </div>
            <div class="row">
            <div class="col-lg-6">
            <div class="mb-3">
            <label class="form-label">Spouse Qualification (optional)</label>
                  <input type="text" name="spouseQualification" class="form-control" value="{{$spouseQualification}}">
            </div>
            </div>
            <div class="col-lg-6">
            <div class="mb-3">
            <label class="form-label">Spouse YOJ (optional)</label>
                  <input type="text" name="spouseYoj" class="form-control" value="{{$spouseYoj}}">
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
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
   <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
</svg>
              Update member details
</button>
          </div>
        </div>
</form>
      </div>
    </div>
    <!-- End modal -->