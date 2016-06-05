<!--Collect Fine Modal-->
 <div class="modal fade" id="collectFineModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="IssueRestrictionController">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Collect Fine</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <h6 ng-bind="responseMessage" class="text-center" style="color:red"></h6>
            <div class="form-group">
            <label>Reader ID</label>
            <input type="text" class="form-control" id="readerName" ng-model="collectfine.id" placeholder="Reader ID">
            <label>Fine For</label>
            <input type="text" class="form-control" ng-model="collectfine.for" placeholder="Fine For"><br />
            <label>Fine Amount</label>
            <input type="number" class="form-control" ng-model="collectfine.amount" placeholder="Amount">
          </div>
          <button type="button" class="btn btn-primary form-control" ng-click="collectFine(collectfine)">Collect</button>
          </div>
        </div>
    </div>
  </div>
</div>
</div>

<!--Program Modal-->
<div class="modal fade bs-example-modal-lg" id="programModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-init="program()">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Program</h4>
      </div>
      <div class="modal-body">
        <h4 ng-show="loading" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h4>
        <h5 ng-bind="responseMessage"></h5>
        <table class="table">
          <thead>
            <th>Code</th>
            <th>Name</th>
            <th>Years</th>
          </thead>
          <tbody>
           <tr ng-repeat="program in programs">
             <td ng-hide="program_checkbox"><% program.code %></td>
             <td ng-show="program_checkbox"><input type="text" class="form-control" ng-model="program.code" ng-value=program.code></td>
             <td ng-hide="program_checkbox"><% program.name %></td>
             <td ng-show="program_checkbox"><input type="text" class="form-control" ng-model="program.name" ng-value=program.name></td>
             <td ng-hide="program_checkbox"><% program.years %></td>
             <td ng-show="program_checkbox"><input type="number" class="form-control" ng-model="program.years" ng-value=program.years></td>
             <td ng-show="program_checkbox"><button class="btn btn-primary" ng-click="updateFine(fine.fine_for,fine_amount)">Update</button></td>
             <td>Edit <input type="checkbox" ng-model="program_checkbox" aria-label="Toggle ngHide">
           </tr>
           <tr ng-show="add_data">
             <td><input type="text" class="form-control" placeholder="Program Code" ng-model="programme.code"></td>
             <td><input type="text" class="form-control" placeholder="Program Name" ng-model="programme.name"></td>
             <td><input type="number" class="form-control" placeholder="Years" ng-model="programme.years"></td>
             <td><button class="btn btn-primary" ng-click="addProgram()">Add</button></td>
           </tr>
          </tbody>
        </table>
      <div class="modal-footer">
        <button class="btn btn-primary" ng-click="add_data=true">Add</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Issue Restriction Modal -->
    <div class="modal fade" id="issueRestrictionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="IssueRestrictionController" ng-init="getRestrictions()">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Issue Restriction</h4>
            </div>
            <div class="modal-body">
              <div style="text-align:center">
                <h6 ng-bind="responseMessage"></h6>
                <h4 ng-show="loading" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h4>
              </div>
              <table class="table">
                <thead>
                  <th>For</th>
                  <th>Days</th>
                  <th>Total Books</th>
                  <th>Fine (&#8377;)</th>
                </thead>
                <tbody>
                  <tr ng-repeat="restriction in restrictions">
                    <td><% restriction.for | uppercase %></td>
                    <td ng-hide="edit_restriction"><% restriction.days %></td>
                    <td ng-hide="edit_restriction"><% restriction.books_for_issue %></td>
                    <td ng-hide="edit_restriction"><% restriction.fine %></td>
                    <td ng-show="edit_restriction"><input type="number" class="form-control" ng-model="restrict.days" ng-value="restriction.days"></td>
                    <td ng-show="edit_restriction"><input type="number" class="form-control" ng-model="restrict.books_for_issue" ng-value="restriction.books_for_issue"></td>
                    <td ng-show="edit_restriction"><input type="number" class="form-control" ng-model="restrict.fine" ng-value="restriction.fine"></td>
                    <td ng-show="edit_restriction"><button class="btn btn-primary btn-xs" ng-click="updateRestriction(restriction.for,restrict)">Update</button></td>
                    <td><input type="checkbox" ng-model="edit_restriction">Edit</td>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>

    <!--Old Records Modal-->
     <div class="modal fade" id="oldRecordsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" ng-controller="OldRecordsController">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Old Records</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <h6 ng-bind="responseMessage" class="text-center" style="color:red"></h6>
                <div class="form-group">
                <label>Year Enrolled</label>
                <input type="number" class="form-control" ng-model="old.year_enrolled" placeholder="Year Enrolled">
                <label>Year</label>
                <select ng-model="old.year" class="form-control">
                  <option value="tybca">TYBCA</option>
                  <option value="symsc">SYMSC</option>
                </select>
              </div>
              <button type="button" class="btn btn-primary form-control" ng-click="getOldRecords(old)">Get Records</button>
              </div>
            </div>
        </div>
      </div>
    </div>
    </div>
