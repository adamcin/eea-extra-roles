<?php
/* @var $roster_config EE_Roster_Config */
?>
<div class="padding">
    <h4>
        <?php _e('Basic Settings', 'event_espresso'); ?>
    </h4>
    <table class="form-table">
        <tbody>
        <tr>
            <th>
                <label for="show_time">
                    <?php _e('This is a field', 'event_espresso'); ?>
                </label>
            </th>
            <td>
                <input name="show_time" placeholder="Do some php here."/>
            </td>
        </tr>

        </tbody>
    </table>\
</div>
<input type='hidden' name="return_action" value="<?php echo $return_action?>"/>
<!-- / .padding -->
