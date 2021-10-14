<template>
    <div>
        <div class="md-layout">
            <md-button class="md-warning" @click="showSetting = !showSetting">
                Settings
            </md-button>
        </div>
        <div class="md-layout" v-show="showSetting">
            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50">
                <md-card>
                    <md-card-header data-background-color="orange">
                        <h4 class="title">Play with the options!</h4>
                    </md-card-header>
                    <md-card-content>
                        <div class="box">
                            <h4 class="title is-5">Play with the options!</h4>

                            <md-field>
                                <label>Period UOM</label>
                                <md-select v-model="displayPeriodUom">
                                    <md-option value="month">month</md-option>
                                    <md-option value="week">week</md-option>
                                    <md-option value="year">year</md-option>
                                </md-select>
                            </md-field>

                            <md-field>
                                <label>Period Count</label>
                                <md-select v-model="displayPeriodCount">
                                    <md-option value="1">1</md-option>
                                    <md-option value="2">2</md-option>
                                    <md-option value="3">3</md-option>
                                </md-select>
                            </md-field>

                            <md-field>
                                <label>Starting day of the week</label>
                                <md-select v-model="startingDayOfWeek">
                                    <md-option v-for="(d, index) in dayNames" :value="index" :key="index" value="1">{{ d
                                        }}
                                    </md-option>
                                </md-select>
                            </md-field>


                            <h6>Today Button</h6>
                            <md-checkbox v-model="useTodayIcons">Icons</md-checkbox>

                            <h6>Theme</h6>
                            <md-checkbox v-model="useDefaultTheme">Default</md-checkbox>
                            <br>
                            <md-checkbox v-model="useHolidayTheme">Holidays</md-checkbox>

                        </div>
                    </md-card-content>
                </md-card>
            </div>


            <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-50">
                <md-card>
                    <md-card-header data-background-color="orange">
                        <h4 class="title">Create new event</h4>
                    </md-card-header>
                    <md-card-content>
                        <div class="box">
                            <div class="field">
                                <md-field>
                                    <label class="label">Title</label>
                                    <md-input v-model="newEventTitle"></md-input>
                                </md-field>
                            </div>

                            <div class="field">
                                <label class="label">Start date</label>
                                <md-field>
                                    <datepicker v-model="newEventStartDate"></datepicker>
                                </md-field>
                            </div>

                            <div class="field">
                                <label class="label">End date</label>
                                <md-field>
                                    <datepicker v-model="newEventEndDate"></datepicker>
                                </md-field>
                            </div>
                            <md-button class="md-primary" @click="clickTestAddEvent">Add Event</md-button>
                        </div>
                    </md-card-content>
                </md-card>

            </div>

        </div>
        <div class="calendar-parent row">
            <calendar-view
                    :events="events"
                    :show-date="showDate"
                    :time-format-options="{hour: 'numeric', minute:'2-digit'}"
                    :enable-drag-drop="true"
                    :disable-past="disablePast"
                    :disable-future="disableFuture"
                    :show-event-times="showEventTimes"
                    :display-period-uom="displayPeriodUom"
                    :display-period-count="displayPeriodCount"
                    :starting-day-of-week="startingDayOfWeek"
                    :class="themeClasses"
                    :period-changed-callback="periodChanged"
                    :current-period-label="useTodayIcons ? 'icons' : ''"
                    @drop-on-date="onDrop"
                    @click-date="onClickDay"
                    @click-event="onClickEvent"
            >
                <calendar-view-header
                        slot="header"
                        slot-scope="{ headerProps }"
                        :header-props="headerProps"
                        @input="setShowDate"
                />
            </calendar-view>
        </div>

        <md-dialog :md-active.sync="showDialog">
            <md-dialog-title>Edit event</md-dialog-title>

            <md-dialog-content>
                <md-field>
                    <label>Initial Value</label>
                    <md-input v-model="editEvent.title"></md-input>
                </md-field>
            </md-dialog-content>

            <md-dialog-actions>
                <md-button class="md-danger" @click="onDeleteEvent">Delete</md-button>
                <md-button class="md-primary" @click="showDialog = false">Close</md-button>
                <md-button class="md-primary" @click="onEditEvent">Save</md-button>
            </md-dialog-actions>
        </md-dialog>

        <md-dialog-confirm
                :md-active.sync="confirmDialog"
                md-title="Confirm deleted"
                md-content="Are you sure you want to delete this item?"
                md-confirm-text="Ok"
                md-cancel-text="Cancel"
                @md-cancel="confirmDialog = false"
                @md-confirm="deleteEvent"/>

    </div>
</template>
<script>
    import Datepicker from '@/components/Datepicker'
    // Load CSS from the published version
    require("vue-simple-calendar/static/css/default.css")
    require("vue-simple-calendar/static/css/holidays-us.css")

    import {
        CalendarView,
        CalendarViewHeader,
        CalendarMathMixin,
    } from "vue-simple-calendar" // published version
    //} from "../../vue-simple-calendar/src/components/bundle.js" // local repo
    export default {
        name: "App",
        components: {
            CalendarView,
            CalendarViewHeader,
            Datepicker
        },
        mixins: [CalendarMathMixin],
        data() {
            return {
                /* Show the current month, and give it some fake events to show */
                showDate: this.thisMonth(1),
                message: "",
                startingDayOfWeek: 1,
                disablePast: false,
                disableFuture: false,
                displayPeriodUom: "month",
                displayPeriodCount: 1,
                showEventTimes: true,
                newEventTitle: "",
                newEventStartDate: "",
                newEventEndDate: "",
                useDefaultTheme: true,
                useHolidayTheme: true,
                useTodayIcons: false,
                /* Dialogs */
                showDialog: false,
                confirmDialog: false,
                showSetting: false,
                editEvent: {
                    title: ''
                },
                events: [
                    {
                        id: "e0",
                        startDate: "2018-01-05",
                    },
                    {
                        id: "e1",
                        startDate: '2019-02-19T22:10:00.000Z',
                    },
                    {
                        id: "e2",
                        startDate: '2019-02-12T22:00:00.000Z',
                        title: "Single-day event with a long title",
                    },
                    {
                        id: "e3",
                        startDate: '2019-02-15T02:00:00.000Z',
                        endDate: 'Sun Feb 10 2019 16:30:00 GMT+0200',
                        title: "Multi-day event with a long title and times",
                    },
                    {
                        id: "e4",
                        startDate: "2019-02-10T22:00:00.000Z",
                        title: "My Birthday!",
                        classes: "birthday",
                        url: "https://en.wikipedia.org/wiki/Birthday",
                    },
                    {
                        id: "e5",
                        startDate: '2019-02-10T22:10:00.000Z',
                        endDate: '2019-02-13T22:14:00.000Z',
                        title: "Multi-day event",
                        classes: "purple",
                    },
                    {
                        id: "foo",
                        startDate: '2019-02-11T12:00:00.000Z',
                        title: "Same day 1",
                    },
                    {
                        id: "e6",
                        startDate: '2019-02-20T22:14:00.000Z',
                        title: "Same day 2",
                        classes: "orange",
                    },
                    {
                        id: "e7",
                        startDate: '2019-02-10T22:00:00.000Z',
                        title: "Same day 3",
                    },
                    {
                        id: "e8",
                        startDate: '2019-02-21T22:01:00.000Z',
                        title: "Same day 4",
                        classes: "orange",
                    },
                ],
            }
        },
        computed: {
            userLocale() {
                return this.getDefaultBrowserLocale
            },
            dayNames() {
                return this.getFormattedWeekdayNames(this.userLocale, "long", 0)
            },
            themeClasses() {
                return {
                    "theme-default": this.useDefaultTheme,
                    "holiday-us-traditional": this.useHolidayTheme,
                    "holiday-us-official": this.useHolidayTheme,
                }
            },
        },
        mounted() {
            this.newEventStartDate = this.isoYearMonthDay(this.today())
            this.newEventEndDate = this.isoYearMonthDay(this.today())
        },
        methods: {
            periodChanged(range, eventSource) {
                // Demo does nothing with this information, just including the method to demonstrate how
                // you can listen for changes to the displayed range and react to them (by loading events, etc.)
                console.log(eventSource)
                console.log(range)
            },
            thisMonth(d, h, m) {
                const t = new Date()
                return new Date(t.getFullYear(), t.getMonth(), d, h || 0, m || 0)
            },
            onClickDay(d) {
                this.message = `You clicked: ${d.toLocaleDateString()}`
            },
            onClickEvent(e) {
                this.message = `You clicked: ${e.title}`
                //this.editEvent = this.events.find(x => x.id === e.id);
                let index = this.events.findIndex(x => x.id === e.id);
                this.editEvent = JSON.parse(JSON.stringify(this.events[index]));
                this.showDialog = true;
            },
            onEditEvent() {
                let index = this.events.findIndex(x => x.id === this.editEvent.id);
                // this.events[index] = this.editEvent;
                this.showDialog = false;
                this.$set(this.events, index, this.editEvent)
            },
            onDeleteEvent() {
                this.confirmDialog = true;
            },
            deleteEvent() {
                let index = this.events.findIndex(x => x.id === this.editEvent.id);
                this.$delete(this.events, index);
                this.showDialog = false;
            },
            setShowDate(d) {
                this.message = `Changing calendar view to ${d.toLocaleDateString()}`
                this.showDate = d
            },
            onDrop(event, date) {
                this.message = `You dropped ${event.id} on ${date.toLocaleDateString()}`
                // Determine the delta between the old start date and the date chosen,
                // and apply that delta to both the start and end date to move the event.
                const eLength = this.dayDiff(event.startDate, date)
                event.originalEvent.startDate = this.addDays(event.startDate, eLength)
                event.originalEvent.endDate = this.addDays(event.endDate, eLength)
            },
            clickTestAddEvent() {
                this.events.push({
                    startDate: this.newEventStartDate,
                    endDate: this.newEventEndDate,
                    title: this.newEventTitle,
                    id:
                        "e" +
                        Math.random()
                            .toString(36)
                            .substr(2, 10),
                })
                this.message = "You added an event!"
            },
        },
    }
</script>

<style lang="scss">
    html,
    body {
        height: 100%;
        margin: 0;
        background-color: #f7fcff;
    }

    #app {
        display: flex;
        flex-direction: row;
        font-family: Calibri, sans-serif;
        width: 95vw;
        min-width: 30rem;
        max-width: 100rem;
        min-height: 40rem;
        margin-left: auto;
        margin-right: auto;
    }

    .calendar-controls {
        margin-right: 1rem;
        min-width: 14rem;
        max-width: 14rem;
    }

    .calendar-parent {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        overflow-x: hidden;
        overflow-y: hidden;
        min-height: 550px;
        max-height: 80vh;
        background-color: white;
    }

    /* For long calendars, ensure each week gets sufficient height. The body of the calendar will scroll if needed */
    .cv-wrapper.period-month.periodCount-2 .cv-week,
    .cv-wrapper.period-month.periodCount-3 .cv-week,
    .cv-wrapper.period-year .cv-week {
        min-height: 6rem;
    }

    /* These styles are optional, to illustrate the flexbility of styling the calendar purely with CSS. */
    /* Add some styling for events tagged with the "birthday" class */
    .theme-default .cv-event.birthday {
        background-color: #e0f0e0;
        border-color: #d7e7d7;
    }

    .theme-default .cv-event.birthday::before {
        content: "\1F382"; /* Birthday cake */
        margin-right: 0.5em;
    }

    /* Dialog */
    .md-dialog {
        max-width: 768px;
    }

    .theme-default .cv-day.past {
        background: #d6cdcd;
    }

    .theme-default .cv-day.outsideOfMonth.today {
        background-color: #FFFFEF;
    }

</style>