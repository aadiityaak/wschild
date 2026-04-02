document.addEventListener("alpine:init", () => {
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
});
