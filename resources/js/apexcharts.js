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
})
