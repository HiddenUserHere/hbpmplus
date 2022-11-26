import './bootstrap';
import { Chart } from 'chart.js/auto'

class App {
    constructor()
    {
        this.chart = this.createChart();
    }

    newToken()
    {
        window.axios.post('/api/newtoken',
            {}).then(response =>
            {
                if (response.status === 201)
                {
                    let apiToken = response.data.token;

                    $('#apitoken').text(`Your API Token is: ${apiToken}`);

                    console.log('API Token: ' + apiToken);

                    setInterval(() => this.generateBeat(apiToken, 1000 + Math.random() * 500), 1000);
                }
            });
    }

    generateBeat(api_token, time)
    {
        window.axios.post('/api/heartbeat/tick',
            {api_token: api_token, time: time}).then(response =>
            {
                if (response.status === 201)
                {
                    let data = response.data;

                    this.addData({ x: data.created_at, y: data.heart_rate });
                }
            });
    }

    createChart()
    {
        return new Chart(
            $('#heartbeats'),
            {
                type: 'line',
                data: {
                    datasets: [{
                        label: 'Heartbeat Rate',
                        data: []
                    }],
                },
            }
        );
    }

    addData(data)
    {
        //Add to top of chart
        this.chart.data.datasets[0].data.unshift(data);

        this.chart.update();
    }
}

let app = new App();

//On page load
$(document).ready(function () {
    $('#generateKey').click(function ()
    {
        app.newToken();
    });

    $('#generateBeat').click(function ()
    {
    });
});