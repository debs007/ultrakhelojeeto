<div class="modal modal-blur fade" id="modal-leaderboard" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <form name="event_form" method="post" action="{{route('webconnect.createAd')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Top scores</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
          
          
          <div class="modal-body">
            <div class="row">
            <div id="table-default" class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><button class="table-sort" data-sort="sort-name">Rank</button></th>
                        <th><button class="table-sort" data-sort="sort-city">Name</button></th>
                        <th><button class="table-sort" data-sort="sort-type">Score</button></th>
                        
                      </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @foreach($allRequests as $ar)
                        
                        <tr>
                        <td class="sort-name">{{++$count}}</td>
                        <td class="sort-city">{{$ar->name}}</td>
                        <td class="sort-type">{{$ar->score}}</td>
                        
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
            <div class="col-lg-12">
            
              </div>
             
            </div>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
              Ok
            </a>
            
          </div>
        </div>
</form>
      </div>
    </div>