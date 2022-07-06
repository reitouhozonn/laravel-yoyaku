
<template>
    <section>
        <div class="form-group">
            <!-- <label>Select a date</label> -->
            <div class="input-group">
                <flat-pickr v-model="date" :config="config" class="form-control" placeholder="Select date"
                    name="date" />
                <div class="input-group-append">
                    <button class="btn btn-default" type="button" title="Toggle" data-toggle>
                        <i class="fa fa-calendar">
                            <span aria-hidden="true" class="sr-only">Toggle</span>
                        </i>
                    </button>
                    <button class="btn btn-default" type="button" title="Clear" data-clear>
                        <i class="fa fa-times">
                            <span aria-hidden="true" class="sr-only">Clear</span>
                        </i>
                    </button>
                </div>
            </div>
        </div>
        <!-- <pre>Selected date is - {{ date }}</pre> -->
    </section>
</template>

<script>
// bootstrap is just for this example
// import 'bootstrap/dist/css/bootstrap.css';
// import this component
import flatPickr from 'vue-flatpickr-component';
// import 'flatpickr/dist/flatpickr.min.css';
// theme is optional
// try more themes at - https://flatpickr.js.org/themes/
import 'flatpickr/dist/themes/material_blue.css';
// localization is optional

import { Japanese } from 'flatpickr/dist/l10n/ja.js';

export default {
    name: 'yourComponent',
    data() {
        return {
            // Initial value can be a date object as well
            date: new Date,
            // Get more form https://flatpickr.js.org/options/
            config: {
                wrap: true, // set wrap to true only when using 'input-group'
                altFormat: 'M j, Y',
                altInput: true,
                dateFormat: 'Y-m-d',
                locale: Japanese,
                minDate: 'today',
                maxDate: new Date().fp_incr(30),
            },
        }
    },
    components: {
        flatPickr
    },
}
</script>
