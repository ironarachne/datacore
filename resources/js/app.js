require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    data: {
        apiToken: '',
        jsonData: '',
        jsonType: '',
        message: '',
        quickSpecies: '',
    },
    methods: {
        createFromJson: function () {
            jsonData = this.jsonData
            this.jsonData = ''

            axios.post('/api/' + this.jsonType, {data: jsonData}, {headers: {'Authorization': 'Bearer ' + this.apiToken}})
                .then(function(response){
                    console.log(response)
                    app.message = 'Created ' + response.data.new_records_count + ' new items from data'
                })
        },
        createQuickRace: function () {
            speciesName = this.quickSpecies
            console.log('Trying to create quick species ' + speciesName)
            axios.post('/quick/race', {name: speciesName})
                .then(function(response){
                    console.log(response)
                    app.quickSpecies = ''
                    app.message = 'Created new race: ' + response.data.name
                })
        }
    },
    mounted: function() {
        this.apiToken = this.$refs.apiToken.value
        this.jsonType = this.$refs.jsonType.value
    }
});
