require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    data: {
        apiToken: '',
        chargeJson: '',
        message: '',
        patternJson: '',
        speciesJson: '',
        quickSpecies: '',
    },
    methods: {
        createChargesFromJson: function () {
            chargeJson = this.chargeJson
            this.chargeJson = ''

            axios.post('/api/charges', {data: chargeJson}, {headers: {'Authorization': 'Bearer ' + this.apiToken}})
                .then(function(response){
                    console.log(response)
                    app.message = 'Created ' + response.data.new_records_count + ' new charges from data'
                })
        },
        createPatternsFromJson: function () {
            patternJson = this.patternJson
            this.patternJson = ''

            axios.post('/api/patterns', {data: patternJson}, {headers: {'Authorization': 'Bearer ' + this.apiToken}})
                .then(function(response){
                    console.log(response)
                    app.message = 'Created ' + response.data.new_records_count + ' new patterns from data'
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
        },
        createSpeciesFromJson: function () {
            speciesJson = this.speciesJson
            this.speciesJson = ''

            axios.post('/api/species', {data: speciesJson}, {headers: {'Authorization': 'Bearer ' + this.apiToken}})
                .then(function(response){
                    console.log(response)
                    app.message = 'Created ' + response.data.new_records_count + ' new species from data'
                })
        }
    },
    mounted: function() {
        this.apiToken = this.$refs.apiToken.value
    }
});
