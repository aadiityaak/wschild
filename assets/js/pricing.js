/**
 * Pricing & Modal Component Logic
 * Using Alpine.data for modern Alpine.js 3 integration
 */

// Define the component function globally so Alpine can find it immediately
window.wschildPricing = function (designs) {
  return {
    designs: designs,
    activeKey: null,
    isOpen: false,
    openDesign(key) {
      this.activeKey = key;
      this.isOpen = true;
    },
    closeDesign() {
      this.isOpen = false;
    },
    active() {
      const empty = { title: "", subtitle: "", items: [] };
      if (!this.activeKey) {
        return empty;
      }
      return this.designs && this.designs[this.activeKey]
        ? this.designs[this.activeKey]
        : empty;
    },
  };
};

// Register the component with Alpine.data when Alpine initializes
document.addEventListener("alpine:init", () => {
  if (typeof Alpine !== "undefined" && Alpine.data) {
    Alpine.data("wschildPricing", window.wschildPricing);
  }
});
