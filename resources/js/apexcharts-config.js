/* Global ApexChart settings */
window.Apex = {
  chart: {
    background: 'transparent',
    toolbar: {
      show: false,
    },
    zoom: {
      enabled: false,
    },
    foreColor: '#6b7280', // Neutral gray that works in both light and dark modes
  },
  dataLabels: {
    enabled: false,
  },
  grid: {
    strokeDashArray: 2,
    borderColor: '#d1d5db', // Light gray border
  },
  legend: {
    position: 'bottom',
    offsetY: 10,
    itemMargin: {
      horizontal: 6,
      vertical: 6,
    },
  },
  stroke: {
    width: 3,
    curve: 'smooth',
  },
  xaxis: {
    tooltip: {
      enabled: false,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  theme: {
    mode: 'light', // Use light mode by default for better text visibility
  },
  tooltip: {
    theme: 'dark', // Dark tooltips work well in both themes
  },
}
