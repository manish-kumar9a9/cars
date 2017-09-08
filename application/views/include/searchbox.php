<div class="searchbox">
    <div class="container">
        <div class="row ">
            <form autocomplete="off"  id="filter_form_element"  action="<?php echo site_url('user/find_car'); ?>">

                <input class="hide" value="<?php echo $this->input->get('city_string'); ?>" name="city_string" id="locality" />
                <input class="hide" value="<?php echo $this->input->get('country_string'); ?>" name="country_string" id="country" />
                <input class="hide" value="<?php echo $this->input->get('find_lon'); ?>" name="find_lon" id="lon_string" />
                <input class="hide" value="<?php echo $this->input->get('find_lat'); ?>" name="find_lat" id="lat_string" />
                <input type="hidden" id="filter_active_element" name="filter_active_element" value="<?php echo $this->input->get('filter_active_element') ?>" >

                <div>
                    <div class="col-lg-3 col-md-3 col-sm-11 col-xs-11 no-gutter" style="border-right: 1px solid #e4e8ea">
                        <div class="row ">
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                <img src="<?php echo base_url(); ?>assets/image/icon_location.svg" />
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-12 title">
                                    <?php echo $this->lang->line('START_LOCATION');?>
                                </div>
                                <div class="col-md-12 subtitle">
                                    <input type="text" id="autocomplete" value="<?php echo ($this->input->get('autocomplete')) ? $this->input->get('autocomplete') : ""; ?>" name="autocomplete"   onFocus="geolocate()"  placeholder="<?php echo $this->lang->line('CURRENT_LOCATION'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 no-gutter startdate">
                        <div class="row ">
                            <div class="col-lg-1 col-md-3 col-sm-2 col-xs-1">
                                <img src="<?php echo base_url(); ?>assets/image/icon_date.svg" />
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                <div class="col-md-12 title">
                                    <?php echo $this->lang->line('START_DATE');?>
                                </div>
                                <div class="col-md-12 subtitle">
                                    <input type="text" name="from" class="datepicker" id="date_picker_start" value="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 no-gutter starttime" style=" border-right: 1px solid #e4e8ea">
                        <div class="row ">
                            <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
                                <img src="<?php echo base_url(); ?>assets/image/icon_time.svg" />
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                <div class="col-md-12 title">
                                    <?php echo $this->lang->line('START_TIME');?>
                                </div>
                                <div class="col-md-12 subtitle">
                                    <input type="text" class="timepicker" id="time_picker_start" value="11:00 AM"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 no-gutter enddate">
                        <div class="row ">
                            <div class="col-lg-1 col-md-3 col-sm-2 col-xs-1">
                                <img src="<?php echo base_url(); ?>assets/image/icon_date.svg" />
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding ">
                                <div class="col-md-12 title">
                                    <?php echo $this->lang->line('END_DATE');?> &nbsp;
                                </div>
                                <div class="col-md-12 subtitle">
                                    <input type="text" name="to" class="datepicker" id="date_picker_end" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 no-gutter endtime" style=" border-right: 1px solid #e4e8ea">
                        <div class="row ">
                            <div class="col-lg-1 col-md-3 col-sm-1 col-xs-1">
                                <img src="<?php echo base_url(); ?>assets/image/icon_time.svg" />
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 no-padding">
                                <div class="col-md-12 title">
                                    <?php echo $this->lang->line('RETURN_TIME');?>
                                </div>
                                <div class="col-md-12 subtitle">
                                    <input type="text" class="timepicker" id="time_picker_end" value="11:00 AM"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12  col-xs-12 no-padding">
                        <button class="button gradient_filter">
                            <span><?php echo $this->lang->line('SEARCH_CARS');?></span>
                            <img src="<?php echo base_url(); ?>assets/image/icon_car.svg" />
                        </button>
                    </div>
                </div>
                <input type="radio"  id="result_page_view_list" name="result_page_view" value="list" style="display:none" <?php echo ($this->input->get('result_page_view') !== "map") ? 'checked' : ''; ?>>
                <input type="radio" id="result_page_view_map" name="result_page_view" value="map" style="display:none" <?php echo ($this->input->get('result_page_view') == "map") ? 'checked' : ''; ?> />
            </form>
        </div>
    </div>
</div>