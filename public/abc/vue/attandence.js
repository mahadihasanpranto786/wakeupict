var vm = new Vue({
    el: '#computed_props',
    data: {
        mobile: "",
        password: "",
        show: true,
        styleobj: {
            fontSize: '22px',
            color: 'black'
        },
        mybtn: true
    },

    methods: {},
    computed: {
        getfullname: function() {
            return this.mobile + " " + this.password;
        }
    }
})