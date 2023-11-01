<div class="container">

    <br>

    <h2><?php echo $page_title; ?></h2>
    <script>
        var lang_general_word_qso_data = '<?php echo lang('general_word_qso_data'); ?>';
    </script>
    <div id="distances_div">
        <form class="form-inline">
            <label class="my-1 mr-2" for="distplot_bands"><?php echo lang('gen_band_selection'); ?></label>
            <select class="custom-select my-1 mr-sm-2"  id="distplot_bands">
                <?php if (count($sats_available) != 0) { ?>
                    <option value="sat">SAT</option>
                <?php } ?>
                <?php foreach($bands_available as $band) {
                    echo '<option value="' . $band . '"' . '>' . $band . '</option>'."\n";
                } ?>
            </select>
            <?php if (count($sats_available) != 0) { ?>
                <label class="my-1 mr-2" for="distplot_sats">Satellite</label>
                <select class="custom-select my-1 mr-sm-2"  id="distplot_sats">
                    <option value="All">All</option>
                    <?php foreach($sats_available as $sat) {
                        echo '<option value="' . $sat . '"' . '>' . $sat . '</option>'."\n";
                    } ?>
                </select>
            <?php } else { ?>
                <input id="distplot_sats" type="hidden" value="All"></input>
            <?php } ?>
            <button id="plot" type="button" name="plot" class="btn btn-primary" onclick="distPlot(this.form)">Plot</button>
        </form>
    </div>

</div>