<div class="ui fullscreen long modal" id='modal'>
  <i class="close icon"></i>
  <div class="ui header">
    <div class="ui ordered steps">
      <div class="step active" id='step1'>
        <div class="content">
          <div class="title">Units</div>
          <div class="description">Select your desired units</div>
        </div>
      </div>
      <div class="step" id='step2'>
        <div class="content">
          <div class="title">Contact Info</div>
          <div class="description">Enter contact information</div>
        </div>
      </div>
      <div class="step" id='step3'>
        <div class="content">
          <div class="title">Confirm Details</div>
          <div class="description">Verify details</div>
        </div>
      </div>
    </div>
  </div>
  <div class="scrollable content">
    <div id = 'container1'>
      <form id="aFormWizard" class = 'ui form' id ='form1'>
        <section>
          <div class="ui container">
            <table id = 'table-units' class ='ui stacked fluid compact table' cellspacing="0" width="100%">
              <thead>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="ui error message"></div>
        </section>
      </form>
    </div>
    <div id = 'container2' style = "display:none">
      <form class="ui form segment" id='form2'>
        <p>Tell Us About Yourself</p>
        <div class="three fields">
          <div class="required field">
            <label>First Name</label>
            <input placeholder="First Name" name="first-name" type="text">
          </div>
          <div class="field">
            <label>Middle Name</label>
            <input placeholder="Middle Name" name="middle-name" type="text">
          </div>
          <div class="required field">
            <label>Last Name</label>
            <input placeholder="Last Name" name="last-name" type="text">
          </div>
        </div>
        <div class="two fields">
          <div class="twelve wide required field">
            <label>Email</label>
            <input placeholder="Email Address" name="email" type="text">
          </div>
          <div class="four wide required field">
            <label>Gender</label>
            <div class="ui selection dropdown">
              <input type="hidden" name="gender">
              <i class="dropdown icon"></i>
              <div class="default text">Gender</div>
              <div class="menu">
                <div class="item" data-value="1">Male</div>
                <div class="item" data-value="0">Female</div>
              </div>
            </div>
          </div>
        </div>
        <div class="required field">
          <label>Company Address (Personal if not applicable)</label>
          <input placeholder="Address" name="address" type="text">
        </div>
        <div class="inline field">
          <div class="ui checkbox">
            <input type="checkbox" name="terms">
            <label>I agree to the terms and conditions</label>
          </div>
        </div>
        <div class="ui error message"></div>
      </form>
    </div>
    <div id = 'container3' style = "display:none">
      <form id="aFormWizard" class = 'ui form' id= 'form3'>
        <h3>form 3</h3>
        <section>
          <div class="fields">
            <div class="seven wide field">
              <label>E-mail</label>
              <input type="text" name="email">
            </div>
            <div class="five wide field">
              <label>Additional E-mail</label>
              <input type="text" name="cc-email">
            </div>
            <div class="four wide field">
              <label>Gender</label>
              <div class="ui selection dropdown">
                <input type="hidden" name="gender">
                <div class="default text">Gender</div>
                <i class="dropdown icon"></i>
                <div class="menu">
                  <div class="item" data-value="1">Male</div>
                  <div class="item" data-value="0">Female</div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </form>
    </div>
  </div>
  <div class="actions">
    <div class="ui red cancel inverted button" id = "btnBack">
      <i class="remove icon"></i>
      Cancel
    </div>
    <div class="ui green ok inverted button" id ="btnNext"'>
      <i class="angle double right icon"></i>
      Next
    </div>
  </div>
</div>