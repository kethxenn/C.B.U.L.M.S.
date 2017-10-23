<div class="ui modal" id='modal'>
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
    <div id = 'form1'>
      <form id="aFormWizard" class = 'ui form'>
        <h3>form 1</h3>
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
    <div id = 'form2' style = "display:none">
      <form id="aFormWizard" class = 'ui form'>
        <h3>form 2</h3>
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
  <div id = 'form3' style = "display:none">
      <form id="aFormWizard" class = 'ui form'>
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
    <div class="ui green ok inverted button" id ="btnNext">
      <i class="angle double right icon"></i>
      Next
    </div>
  </div>
</div>