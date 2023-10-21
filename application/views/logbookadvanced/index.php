<script type="text/javascript">
/*
 *
 * Define custom date format
 *
 */
var custom_date_format = "<?php echo $custom_date_format ?>";
<?php
if (!isset($options)) {
   $options = "{\"datetime\":{\"show\":\"true\"},\"de\":{\"show\":\"true\"},\"dx\":{\"show\":\"true\"},\"mode\":{\"show\":\"true\"},\"rstr\":{\"show\":\"true\"},\"rsts\":{\"show\":\"true\"},\"band\":{\"show\":\"true\"},\"myrefs\":{\"show\":\"true\"},\"refs\":{\"show\":\"true\"},\"name\":{\"show\":\"true\"},\"qslvia\":{\"show\":\"true\"},\"qsl\":{\"show\":\"true\"},\"lotw\":{\"show\":\"true\"},\"eqsl\":{\"show\":\"true\"},\"qslmsg\":{\"show\":\"true\"},\"dxcc\":{\"show\":\"true\"},\"state\":{\"show\":\"true\"},\"cqzone\":{\"show\":\"true\"},\"iota\":{\"show\":\"true\"}}";
}
echo "var user_options = $options;";
?>
</script>
<style>
/*Legend specific*/
.legend {
  padding: 6px 8px;
  font: 14px Arial, Helvetica, sans-serif;
  background: white;
  line-height: 24px;
  color: #555;
  border-radius: 10px;
}
.legend h4 {
  text-align: center;
  font-size: 16px;
  margin: 2px 12px 8px;
  color: #777;
}
.legend span {
  position: relative;
  bottom: 3px;
}
.legend i {
  width: 18px;
  height: 18px;
  float: left;
  margin: 0 8px 0 0;
}
</style>
<?php
$options = json_decode($options);
?>
<div class="container-fluid qso_manager pt-3 pl-4 pr-4">
    <?php if ($this->session->flashdata('message')) { ?>
    <!-- Display Message -->
    <div class="alert-message error">
        <p><?php echo $this->session->flashdata('message'); ?></p>
    </div>
    <?php } ?>
    <div class="row">

        <form id="searchForm" name="searchForm" action="<?php echo base_url()."index.php/logbookadvanced/search";?>"
            method="post">
            <div class="filterbody collapse">
                <div class="form-row">
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="dateFrom">From</label>
                        <div class="input-group input-group-sm date" id="dateFrom" data-target-input="nearest">
                            <input name="dateFrom" type="text" placeholder="<?php echo $datePlaceholder;?>"
                                class="form-control" data-target="#dateFrom" />
                            <div class="input-group-append" data-target="#dateFrom" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label for="dateTo">To</label>
                        <div class="input-group input-group-sm date" id="dateTo" data-target-input="nearest">
                            <input name="dateTo" type="text" placeholder="<?php echo $datePlaceholder;?>"
                                class="form-control" data-target="#dateTo" />
                            <div class="input-group-append" data-target="#dateTo" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="de">De</label>
                        <select id="de" name="de" class="form-control form-control-sm">
                            <option value="">All</option>
                            <?php
					foreach($deOptions as $deOption){
						?><option value="<?php echo htmlentities($deOption);?>"><?php echo htmlspecialchars($deOption);?></option><?php
					}
					?>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="dx">Dx</label>
                        <input type="text" name="dx" id="dx" class="form-control form-control-sm" value="">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="dxcc">DXCC</label>
                        <select class="form-control form-control-sm" id="dxcc" name="dxcc">
                            <option value="">-</option>
                            <option value="0">- NONE - (e.g. /MM, /AM)</option>
                            <?php
					foreach($dxccarray as $dxcc){
						echo '<option value=' . $dxcc->adif;
						echo '>' . $dxcc->prefix . ' - ' . ucwords(strtolower($dxcc->name), "- (/");
						if ($dxcc->Enddate != null) {
							echo ' - (Deleted DXCC)';
						}
						echo '</option>';
					}
					?>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="iota">IOTA</label>
                        <select class="form-control form-control-sm" id="iota" name="iota">
                            <option value="">-</option>
                            <?php
					foreach($iotaarray as $iota){
						echo '<option value=' . $iota->tag;
						echo '>' . $iota->tag . ' - ' . $iota->name . '</option>';
					}
					?>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="state">State</label>
                        <input type="text" name="state" id="state" class="form-control form-control-sm" value="">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="gridsquare">Gridsquare</label>
                        <input type="text" name="gridsquare" id="gridsquare" class="form-control form-control-sm"
                            value="">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="mode">Mode</label>
                        <select id="mode" name="mode" class="form-control form-control-sm">
                            <option value="">All</option>
                            <?php
					foreach($modes as $modeId => $mode){
						?><option value="<?php echo htmlspecialchars($mode);?>"><?php echo htmlspecialchars($mode);?></option><?php
					}
					?>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="band">Band</label>
                        <select id="band" name="band" class="form-control form-control-sm">
                            <option value="">All</option>
                            <?php
					foreach($bands as $band){
						?><option value="<?php echo htmlentities($band);?>"><?php echo htmlspecialchars($band);?></option><?php
					}
					?>
                        </select>
                    </div>
                    <div hidden class="sats_dropdown form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="sats">Satellite</label>
                        <select class="form-control form-control-sm" id="sats">
                            <option value="All">All</option>
                            <?php foreach($sats as $sat) {
					echo '<option value="' . htmlentities($sat) . '"' . '>' . htmlentities($sat) . '</option>'."\n";
				} ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="selectPropagation">Propagation</label>
                        <select id="selectPropagation" name="selectPropagation" class="form-control form-control-sm">
                            <option value="">All</option>
                            <option value="AS">Aircraft Scatter</option>
                            <option value="AUR">Aurora</option>
                            <option value="AUE">Aurora-E</option>
                            <option value="BS">Back scatter</option>
                            <option value="ECH">EchoLink</option>
                            <option value="EME">Earth-Moon-Earth</option>
                            <option value="ES">Sporadic E</option>
                            <option value="FAI">Field Aligned Irregularities</option>
                            <option value="F2">F2 Reflection</option>
                            <option value="INTERNET">Internet-assisted</option>
                            <option value="ION">Ionoscatter</option>
                            <option value="IRL">IRLP</option>
                            <option value="MS">Meteor scatter</option>
                            <option value="RPT">Terrestrial or atmospheric repeater or transponder</option>
                            <option value="RS">Rain scatter</option>
                            <option value="SAT">Satellite</option>
                            <option value="TEP">Trans-equatorial</option>
                            <option value="TR">Tropospheric ducting</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="cqzone">CQ Zone</label>
                        <select id="cqzone" name="cqzone" class="form-control form-control-sm">
                            <option value="">All</option>
                            <?php
                      for ($i = 1; $i<=40; $i++) {
                          echo '<option value="'. $i . '">'. $i .'</option>';
                      }
                      ?>
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="sota">SOTA</label>
                        <input type="text" name="sota" id="sota" class="form-control form-control-sm" value="">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="wwff">WWFF</label>
                        <input type="text" name="wwff" id="wwff" class="form-control form-control-sm" value="">
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                        <label class="form-label" for="pota">POTA</label>
                        <input type="text" name="pota" id="pota" class="form-control form-control-sm" value="">
                    </div>
                </div>
            </div>
    </div>
    <div class="qslfilterbody collapse">
        <div class="form-row">
            <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                <label for="qslSent">QSL Sent</label>
                <select id="qslSent" name="qslSent" class="form-control form-control-sm">
                    <option value="">All</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                    <option value="R">Requested</option>
                    <option value="Q">Queued</option>
                    <option value="I">Ignore/Invalid</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                <label for="qslReceived">QSL Received</label>
                <select id="qslReceived" name="qslReceived" class="form-control form-control-sm">
                    <option value="">All</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                    <option value="R">Requested</option>
                    <option value="I">Ignore/Invalid</option>
                    <option value="V">Verified</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                <label for="lotwSent">LoTW Sent</label>
                <select id="lotwSent" name="lotwSent" class="form-control form-control-sm">
                    <option value="">All</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                    <option value="R">Requested</option>
                    <option value="Q">Queued</option>
                    <option value="I">Ignore/Invalid</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                <label for="lotwReceived">LoTW Received</label>
                <select id="lotwReceived" name="lotwReceived" class="form-control form-control-sm">
                    <option value="">All</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                    <option value="R">Requested</option>
                    <option value="I">Ignore/Invalid</option>
                    <option value="V">Verified</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                <label for="eqslSent">eQSL Sent</label>
                <select id="eqslSent" name="eqslSent" class="form-control form-control-sm">
                    <option value="">All</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                    <option value="R">Requested</option>
                    <option value="Q">Queued</option>
                    <option value="I">Ignore/Invalid</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                <label for="eqslReceived">eQSL Received</label>
                <select id="eqslReceived" name="eqslReceived" class="form-control form-control-sm">
                    <option value="">All</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                    <option value="R">Requested</option>
                    <option value="I">Ignore/Invalid</option>
                    <option value="V">Verified</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                <label for="qslvia">QSL Via</label>
                <datalist id="qslvia" name="qslvia">
                    <option value="">All</option>
                    <option value="B">Bureau</option>
                    <option value="D">Direct</option>
                    <option value="E">Electronic</option>
                    <option value="M">Manager</option>
                </datalist>
                <input type="search" list="qslvia" name="qslviainput" class="custom-select custom-select-sm">
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-3 col-xl">
                <label for="qslimages">QSL Images</label>
                <select class="form-control form-control-sm" id="qslimages" name="qslimages">
                    <option value="">-</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
            </div>
        </div>
    </div>

    <div class="actionbody collapse">
        <div class="mb-2 btn-group">
            <span class="h6 mr-1">With selected:</span>
            <button type="button" class="btn btn-sm btn-primary mr-1" id="btnUpdateFromCallbook">Update from
                Callbook</button>
            <button type="button" class="btn btn-sm btn-primary mr-1" id="queueBureau">Queue Bureau</button>
            <button type="button" class="btn btn-sm btn-primary mr-1" id="queueDirect">Queue Direct</button>
            <button type="button" class="btn btn-sm btn-primary mr-1" id="queueElectronic">Queue Electronic</button>
            <button type="button" class="btn btn-sm btn-success mr-1" id="sentBureau">Sent Bureau</button>
            <button type="button" class="btn btn-sm btn-success mr-1" id="sentDirect">Sent Direct</button>
            <button type="button" class="btn btn-sm btn-success mr-1" id="sentElectronic">Sent Electronic</button>
            <button type="button" class="btn btn-sm btn-warning mr-1" id="dontSend">Not Sent</button>
            <button type="button" class="btn btn-sm btn-warning mr-1" id="notRequired">QSL Not Required</button>
            <button type="button" class="btn btn-sm btn-warning mr-1" id="receivedBureau">Received (bureau)</button>
            <button type="button" class="btn btn-sm btn-warning mr-1" id="receivedDirect">Received (direct)</button>
            <button type="button" class="btn btn-sm btn-info mr-1" id="exportAdif">Create ADIF</button>
            <button type="button" class="btn btn-sm btn-info mr-1" id="printLabel">Print Label</button>
            <button type="button" class="btn btn-sm btn-info mr-1" id="qslSlideshow">QSL Slideshow</button>
            <button type="button" class="btn btn-sm btn-danger mr-1" id="deleteQsos">Delete</button>
        </div>
    </div>
    <div class="quickfilterbody collapse">
        <div class="mb-2 btn-group">
            <span class="h6 mr-1">Quick search with selected:</span>
			<?php if (($options->dx->show ?? "true") == "true") {
				echo '<button type="button" class="btn btn-sm btn-primary mr-1" id="searchCallsign">Search Callsign</button>';
			} ?>
			<?php if (($options->dxcc->show ?? "true") == "true") {
				echo '<button type="button" class="btn btn-sm btn-primary mr-1" id="searchDxcc">Search DXCC</button>';
			} ?>
			<?php if (($options->iota->show ?? "true") == "true") {
				echo '<button type="button" class="btn btn-sm btn-primary mr-1" id="searchIota">Search IOTA</button>';
			} ?>
			<?php if (($options->state->show ?? "true") == "true") {
				echo '<button type="button" class="btn btn-sm btn-primary mr-1" id="searchState">Search State</button>';
			} ?>
			<?php if (($options->refs->show ?? "true") == "true") {
				echo '<button type="button" class="btn btn-sm btn-primary mr-1" id="searchGridsquare">Search Gridsquare</button>';
			} ?>
			<?php if (($options->cqzone->show ?? "true") == "true") {
				echo '<button type="button" class="btn btn-sm btn-primary mr-1" id="searchCqZone">Search CQ Zone</button>';
			} ?>
			<?php if (($options->mode->show ?? "true") == "true") {
				echo '<button type="button" class="btn btn-sm btn-primary mr-1" id="searchMode">Search Mode</button>';
			} ?>
			<?php if (($options->band->show ?? "true") == "true") {
				echo '<button type="button" class="btn btn-sm btn-primary mr-1" id="searchBand">Search Band</button>';
			} ?>
			<?php if (($options->refs->show ?? "true") == "true") {
				echo '<button type="button" class="btn btn-sm btn-primary mr-1" id="searchSota">Search SOTA</button>';
				echo '<button type="button" class="btn btn-sm btn-primary mr-1" id="searchWwff">Search WWFF</button>';
				echo '<button type="button" class="btn btn-sm btn-primary mr-1" id="searchPota">Search POTA</button>';
			} ?>
        </div>
    </div>
<div class="form-row pt-2">
    <div class="form-group form-inline col-lg d-flex flex-row justify-content-center align-items-center">
        <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="collapse"
            data-target=".quickfilterbody">Quickfilters</button>
        <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="collapse"
            data-target=".qslfilterbody">QSL Filters</button>
        <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="collapse"
            data-target=".filterbody">Filters</button>
        <button type="button" class="btn btn-sm btn-primary mr-1" data-toggle="collapse"
            data-target=".actionbody">Actions</button>
        <label for="qsoResults" class="mr-2"># Results</label>
        <select id="qsoResults" name="qsoResults" class="form-control form-control-sm mr-2">
            <option value="250">250</option>
            <option value="1000">1000</option>
            <option value="2500">2500</option>
            <option value="5000">5000</option>
        </select>
        <button type="submit" class="btn btn-sm btn-primary mr-1" id="searchButton">Search</button>
        <button type="button" class="btn btn-sm btn-primary mr-1" id="mapButton" onclick="mapQsos(this.form);">Map</button>
		<button type="options" class="btn btn-sm btn-primary mr-1" id="optionButton">Options</button>
		<button type="reset" class="btn btn-sm btn-danger mr-1" id="resetButton">Reset</button>

    </div>
</div>
</form>
<table style="width:100%" class="table-sm table table-bordered table-hover table-striped table-condensed text-center" id="qsoList">
    <thead>
        <tr>
            <th>
                <div class="form-check" style="margin-top: -1.5em"><input class="form-check-input" type="checkbox" id="checkBoxAll" /></div>
            </th>
			<?php if (($options->datetime->show ?? "true") == "true") {
				echo '<th>Date/Time</th>';
			} ?>
			<?php if (($options->de->show ?? "true") == "true") {
				echo '<th>De</th>';
			} ?>
			<?php if (($options->dx->show ?? "true") == "true") {
				echo '<th>Dx</th>';
			} ?>
			<?php if (($options->mode->show ?? "true") == "true") {
				echo '<th>Mode</th>';
			} ?>
			<?php if (($options->rsts->show ?? "true") == "true") {
				echo '<th>RST (S)</th>';
			} ?>
			<?php if (($options->rstr->show ?? "true") == "true") {
				echo '<th>RST (R)</th>';
			} ?>
            <?php if (($options->band->show ?? "true") == "true") {
				echo '<th>Band</th>';
			} ?>
			<?php if (($options->myrefs->show ?? "true") == "true") {
				echo '<th>My Refs</th>';
			} ?>
			<?php if (($options->refs->show ?? "true") == "true") {
				echo '<th>Refs</th>';
			} ?>
			<?php if (($options->name->show ?? "true") == "true") {
				echo '<th>Name</th>';
			} ?>
			<?php if (($options->qslvia->show ?? "true") == "true") {
				echo '<th>QSL Via</th>';
			} ?>
			<?php if (($options->qsl->show ?? "true") == "true") {
				echo '<th>QSL</th>';
			} ?>
            <?php if ($this->session->userdata('user_eqsl_name') != ""  && ($options->eqsl->show ?? "true") == "true"){
					echo '<th class="eqslconfirmation">eQSL</th>';
				} ?>
            <?php if ($this->session->userdata('user_lotw_name') != "" && ($options->lotw->show ?? "true") == "true"){
					echo '<th class="lotwconfirmation">LoTW</th>';
				} ?>
			<?php if (($options->qslmsg->show ?? "true") == "true") {
				echo '<th>QSL Msg</th>';
			} ?>
			<?php if (($options->dxcc->show ?? "true") == "true") {
				echo '<th>DXCC</th>';
			} ?>
			<?php if (($options->state->show ?? "true") == "true") {
				echo '<th>State</th>';
			} ?>
			<?php if (($options->cqzone->show ?? "true") == "true") {
				echo '<th>CQ Zone</th>';
			} ?>
			<?php if (($options->iota->show ?? "true") == "true") {
				echo '<th>IOTA</th>';
			} ?>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
