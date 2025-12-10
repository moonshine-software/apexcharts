import ApexCharts from 'apexcharts'
import './apexcharts-config.js'

function initChart(element, config, events, chartName) {
  if (!config) {
    console.error(`${chartName}: config is missing`)
    return null
  }

  if (events && events !== '{}') {
    if (!config.chart) {
      config.chart = {}
    }
    config.chart.events = events
  }

  const instance = new ApexCharts(element, config)

  setTimeout(() => {
    instance.render()
  }, 300)

  return instance
}

document.addEventListener('alpine:init', () => {
  Alpine.data('donutChart', (options = {}) => ({
    apexchartsInstance: null,
    config: options.config || {},
    events: options.events || '{}',
    decimals: options.decimals || 3,

    init() {
      if (this.config.plotOptions?.pie?.donut?.labels?.total) {
        this.config.plotOptions.pie.donut.labels.total.formatter = (w) => {
          return Number(w.globals.seriesTotals.reduce((a, b) => a + b, 0).toFixed(this.decimals))
        }
      }

      if (this.config.tooltip?.y) {
        if (!this.config.tooltip.y.formatter) {
          this.config.tooltip.y.formatter = (val) => `${val}`
        }
        if (this.config.tooltip.y.title && !this.config.tooltip.y.title.formatter) {
          this.config.tooltip.y.title.formatter = (seriesName) => `${seriesName}:`
        }
      }

      this.apexchartsInstance = initChart(this.$el, this.config, this.events, 'DonutChart')
    }
  }))

  Alpine.data('lineChart', (options = {}) => ({
    apexchartsInstance: null,
    config: options.config || {},
    events: options.events || '{}',

    init() {
      this.apexchartsInstance = initChart(this.$el, this.config, this.events, 'LineChart')
    }
  }))

  Alpine.data('rawDataChart', (options = {}) => ({
    apexchartsInstance: null,
    config: options.config || {},
    events: options.events || '{}',

    init() {
      this.apexchartsInstance = initChart(this.$el, this.config, this.events, 'RawDataChart')
    }
  }))
})
