require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    data: {
        message: '',
        quickSpecies: '',
    },
    methods: {
        createQuickRace: function () {
            speciesName = this.quickSpecies
            console.log('Trying to create quick species ' + speciesName)
            axios.post('/quick/race', {name: speciesName})
                .then(function(response){
                    console.log(response);
                    app.quickSpecies = '';
                    app.message = 'Created new race: ' + response.data.name
                })
        }
    }
});
