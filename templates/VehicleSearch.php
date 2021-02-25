<?php
    /**
     * Vehicle search (search parameters and filters) template.
     *
     * This template can be overriden by copying this file to your-theme/biltorvet-dealer-tools/VehicleSearch.php
     *
     * @author 		Biltorvet A/S
     * @package 	Biltorvet Dealer Tools
     * @version     1.0.0
     */

    if (!defined( 'ABSPATH' )) exit; // Exit if accessed directly
    
    global $wp;
    $root = dirname(dirname(dirname(plugin_dir_url( __FILE__ ))));
    $currentPage = get_query_var('bdt_page', -1);
    $bdt_root_url = home_url( $wp->request );

    if($currentPage === -1)
    {
        $currentPage = 1;
    } else {
        $bdt_root_url = rtrim($bdt_root_url,'/');
    }

    $makeIds = null;
    if(isset($atts) && isset($atts['makeids']) && trim($atts['makeids']) !== '')
    {
        $makeIds = $atts['makeids'];
    }

    // The initial filter is only here to hide dropdowns with one value only, so they don't "flash" before Ajax executes.
    // All filter logic should be in JS.
    try{
        $filterObject = null;
        if(isset($this->_options['hide_sold_vehicles']) && $this->_options['hide_sold_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideSoldVehicles = 'true';
        }
        if(isset($this->_options_2['hide_leasing_vehicles']) && $this->_options_2['hide_leasing_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideLeasingVehicles = 'true';
        }
        if(isset($this->_options_2['hide_flexleasing_vehicles']) && $this->_options_2['hide_flexleasing_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideFlexLeasingVehicles = 'true';
        }
        if(isset($this->_options_2['hide_warehousesale_vehicles']) && $this->_options_2['hide_warehousesale_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideWarehousesaleVehicles = 'true';
        }
        if(isset($this->_options_2['hide_export_vehicles']) && $this->_options_2['hide_export_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideExportVehicles = 'true';
        }
        if(isset($this->_options_2['hide_upcoming_vehicles']) && $this->_options_2['hide_upcoming_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideUpcomingVehicles = 'true';
        }
        if(isset($this->_options_2['hide_rental_vehicles']) && $this->_options_2['hide_rental_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideRentalVehicles = 'true';
        }
        if(isset($this->_options_2['hide_commission_vehicle']) && $this->_options_2['hide_commission_vehicle'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideCommissionVehicles = 'true';
        }
        if(isset($this->_options_2['hide_wholesale_vehicle']) && $this->_options_2['hide_wholesale_vehicle'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideWholesaleVehicles = 'true';
        }
        if(isset($this->_options_2['hide_typecar_vehicles']) && $this->_options_2['hide_typecar_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideByTypeCar = 'true';
        }
        if(isset($this->_options_2['hide_typevan_vehicles']) && $this->_options_2['hide_typevan_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideByTypeVan = 'true';
        }
        if(isset($this->_options_2['hide_typemotorcycle_vehicles']) && $this->_options_2['hide_typemotorcycle_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideByTypeMotorcycle = 'true';
        }
        if(isset($this->_options_2['hide_typetruck_vehicles']) && $this->_options_2['hide_typetruck_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideByTypeTruck = 'true';
        }
        if(isset($this->_options_2['hide_typebus_vehicles']) && $this->_options_2['hide_typebus_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideByTypeBus = 'true';
        }
        if(isset($this->_options_2['hide_brandnew_vehicles']) && $this->_options_2['hide_brandnew_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideBrandNewVehicles = 'true';
        }
        if(isset($this->_options['hide_ad_vehicles']) && $this->_options['hide_ad_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideADVehicles = 'true';
        }
        if(isset($this->_options['hide_bi_vehicles']) && $this->_options['hide_bi_vehicles'] === 'on')
        {
            if($filterObject === null)
            {
                $filterObject = new BDTFilterObject();
            }
            $filterObject->HideBIVehicles = 'true';
        }
        $initialFilterOptions = $this->biltorvetAPI->GetFilterOptions($filterObject);
    } catch(Exception $e) {
        die($e->getMessage());
    }
    ?>

    <div class="bdt">
        <div class="vehicle_search"<?php echo $makeIds !== null ? ' data-makeids="'.$makeIds.'"' : '';  ?>>
            <div class="row">
                <?php if(count((array)$initialFilterOptions->companies) > 1) { ?>
                    <div class="col-sm-4 mb-1 mb-sm-3">
                        <select name="company" id="company">
                            <option value=""><?php _e('- Select department -', 'biltorvet-dealer-tools'); ?></option>
                        </select>
                    </div>
                <?php } ?>

                <?php if(count((array)$initialFilterOptions->vehicleStates) >= 2): ?>
                    <div class="col-sm-4 mb-1 mb-sm-3">
                        <select name="vehicleState">
                            <option value=""><?php _e('- Select vehicle state -', 'biltorvet-dealer-tools'); ?></option>
                        </select>
                    </div>
                <?php endif; ?>

                <?php if(count((array)$initialFilterOptions->companies) > 1 || count($initialFilterOptions->makes) >= 1): ?>
                <div class="col-sm-4 mb-1 mb-sm-3">
                    <select name="make" id="make">
                        <option value=""><?php _e('- Select make -', 'biltorvet-dealer-tools'); ?></option>
                    </select>
                </div>
                <?php endif; ?>

                <div class="col-sm-4 mb-1 mb-sm-3">
                    <select name="model">
                        <option value=""><?php _e('- Select model -', 'biltorvet-dealer-tools'); ?></option>
                    </select>
                </div>

                <?php if(count((array)$initialFilterOptions->companies) > 2 || count($initialFilterOptions->productTypes) > 1) { ?>
                    <div class="col-sm-4 mb-1 mb-sm-3">
                        <select name="productType">
                            <option value=""><?php _e('- Select vehicle type -', 'biltorvet-dealer-tools'); ?></option>
                        </select>
                    </div>
                <?php } ?>

                <?php if(count((array)$initialFilterOptions->companies) > 1 || count($initialFilterOptions->bodyTypes) > 1) { ?>
                    <div class="col-sm-4 mb-1 mb-sm-3">
                        <select name="bodyType">
                            <option value=""><?php _e('- Select body type -', 'biltorvet-dealer-tools'); ?></option>
                        </select>
                    </div>
                <?php } ?>

                <?php if(count((array)$initialFilterOptions->companies) > 1 || count($initialFilterOptions->propellants) > 1) { ?>
                    <div class="col-sm-4 mb-1 mb-sm-3">
                        <select name="propellant">
                            <option value=""><?php _e('- Select propellant -', 'biltorvet-dealer-tools'); ?></option>
                        </select>
                    </div>
                <?php } ?>

            </div>
            <div class="row">
                <div class="col-sm-4 mt-3 mt-sm-0 mb-3">
                    <div class="bdtSliderContainer">
                        <label for="priceRange" class="float-left"><?php _e('Price', 'biltorvet-dealer-tools'); ?></label>
                        <span class="float-right"><span class="bdtSliderMinVal"></span> - <span class="bdtSliderMaxVal"></span></span>
                        <span class="clearfix"></span>
                        <input class="bdtSlider" id="priceRange" type="text" />
                    </div>
                </div>
                <div class="col-sm-4 mb-3">
                    <div class="bdtSliderContainer">
                        <label for="consumptionRange" class="float-left"><?php _e('Consumption', 'biltorvet-dealer-tools'); ?></label>
                        <span class="float-right"><span class="bdtSliderMinVal"></span> - <span class="bdtSliderMaxVal"></span>km/l</span>
                        <span class="clearfix"></span>
                        <input class="bdtSlider" id="consumptionRange" type="text" />
                    </div>
                </div>
                <div class="col-sm-4 text-center text-sm-right">
                    <button type="button" data-labelpattern="<?php _e('Show %u vehicles', 'biltorvet-dealer-tools'); ?>" class="et_pb_button search bdt_bgcolor"><?php printf(__('Show %u vehicles', 'biltorvet-dealer-tools'), do_shortcode('[bdt_vehicletotalcount]')); ?></button>
                    <button type="button" class="reset bdt_color mt-4 mt-sm-2"><?php _e('Reset', 'biltorvet-dealer-tools'); ?></button>

                </div>
            </div>
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>