class ChartManager {
    constructor() {
        this.chart = null;
        this.xspan = 60; // Interval in seconds for each candle
        this.klines = [];
        this.candleseries = null;
        this.domElement = document.getElementById("tvchart");
        this.apiKey = "bff3fbf39f-09da4c4519-slvm2l"; // Your FastForex API key
        this.initializeChart();
        this.loadData();
    }

    initializeChart() {
        const chartProperties = {
            timeScale: {
                timeVisible: true,
                secondsVisible: true,
            },
            crosshair: {
                mode: LightweightCharts.CrosshairMode.Normal,
            },
        };
        this.chart = LightweightCharts.createChart(this.domElement, chartProperties);
        this.candleseries = this.chart.addCandlestickSeries();
    }

    async loadData() {
        try {
            const now = Math.floor(Date.now() / 1000);
            const historicalData = [];

            for (let i = 100; i > 0; i--) {
                const timestamp = now - i * this.xspan;
                const open = 100 + Math.random() * 10; // Random start price around 100
                const close = open + (Math.random() - 0.5) * 5;
                const high = Math.max(open, close) + Math.random() * 2;
                const low = Math.min(open, close) - Math.random() * 2;

                historicalData.push({
                    time: timestamp,
                    open: parseFloat(open.toFixed(4)),
                    high: parseFloat(high.toFixed(4)),
                    low: parseFloat(low.toFixed(4)),
                    close: parseFloat(close.toFixed(4)),
                });
            }

            this.klines = historicalData;
            this.candleseries.setData(this.klines);

            setInterval(() => this.fetchRealtimeData(), 1000);
        } catch (error) {
            console.error("Error fetching or parsing data:", error);
        }
    }

    async fetchRealtimeData() {
        try {
            const response = await fetch(`https://api.fastforex.io/fetch-all?api_key=${this.apiKey}`);
            const data = await response.json();

            if (data && data.results && data.results.EUR) {
                const currentPrice = data.results.EUR;
                const timestamp = Math.floor(Date.now() / 1000);

                // Generating random values around current price
                const open = currentPrice;
                const close = open + (Math.random() - 0.5) * 0.5; // Small fluctuation
                const high = Math.max(open, close) + Math.random() * 0.3;
                const low = Math.min(open, close) - Math.random() * 0.3;

                this.candleseries.update({
                    time: timestamp,
                    open: parseFloat(open.toFixed(4)),
                    high: parseFloat(high.toFixed(4)),
                    low: parseFloat(low.toFixed(4)),
                    close: parseFloat(close.toFixed(4)),
                });
            }
        } catch (error) {
            console.error("Error fetching real-time data:", error);
        }
    }
}

const manager = new ChartManager();