import ApexCharts from 'apexcharts'
import './apexcharts-config.js'

document.addEventListener('alpine:init', () => {
  Alpine.data('donutChart', (options = {}) => ({
    apexchartsInstance: null,
    config: options.config || {},
    events: options.events || '{}',
    decimals: options.decimals || 3,
    init() {
      if (!this.config) {
        console.error('DonutChart: config is missing')
        return
      }

      if (this.events && this.events !== '{}') {
        if (!this.config.chart) {
          this.config.chart = {}
        }
        this.config.chart.events = this.events
      }

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

      this.apexchartsInstance = new ApexCharts(this.$el, this.config)

      setTimeout(() => {
        this.apexchartsInstance.render()
      }, 300)
    }
  }))

  Alpine.data('charts', (options = {}) => ({
    apexchartsInstance: null,
    config: options.config || {},
    events: options.events || '{}',
    init() {
      if (!this.config) {
        console.error('Charts: config is missing')
        return
      }

      if (this.events && this.events !== '{}') {
        if (!this.config.chart) {
          this.config.chart = {}
        }
        this.config.chart.events = this.events
      }

      this.apexchartsInstance = new ApexCharts(this.$el, this.config)

      setTimeout(() => {
        this.apexchartsInstance.render()
      }, 300)
    }
  }))

  Alpine.data('rawDataChart', (options = {}) => ({
    apexchartsInstance: null,
    config: options.config || {},
    events: options.events || '{}',
    init() {
      if (!this.config) {
        console.error('RawDataChart: config is missing')
        return
      }

      if (this.events && this.events !== '{}') {
        if (!this.config.chart) {
          this.config.chart = {}
        }
        this.config.chart.events = this.events
      }

      this.apexchartsInstance = new ApexCharts(this.$el, this.config)

      setTimeout(() => {
        this.apexchartsInstance.render()
      }, 300)
    }
  }))
})
