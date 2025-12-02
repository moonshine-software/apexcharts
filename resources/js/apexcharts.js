import ApexCharts from 'apexcharts'
import './apexcharts-config.js'

document.addEventListener('alpine:init', () => {
  Alpine.data('charts', (options = {}) => ({
    apexchartsInstance: null,
    init() {
      this.apexchartsInstance = new ApexCharts(this.$el, options)

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

      const config = this.mergeDeep(window.Apex || {}, this.config)

      if (this.events && this.events !== '{}') {
        if (!config.chart) {
          config.chart = {}
        }
        config.chart.events = this.events
      }

      this.apexchartsInstance = new ApexCharts(this.$el, config)

      setTimeout(() => {
        this.apexchartsInstance.render()
      }, 300)
    },

    // Рекурсивное объединение объектов
    mergeDeep(target, source) {
      const result = {...target}

      for (const key in source) {
        if (source.hasOwnProperty(key)) {
          if (typeof source[key] === 'object' && source[key] !== null && !Array.isArray(source[key])) {
            result[key] = this.mergeDeep(result[key] || {}, source[key])
          } else {
            result[key] = source[key]
          }
        }
      }

      return result
    }
  }))
})
