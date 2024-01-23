(() => {
  // node_modules/@fancyapps/ui/dist/index.esm.js
  var t = (t3, e3 = 1e4) => (t3 = parseFloat(t3 + "") || 0, Math.round((t3 + Number.EPSILON) * e3) / e3);
  var e = function(t3) {
    if (!(t3 && t3 instanceof Element && t3.offsetParent))
      return false;
    const e3 = t3.scrollHeight > t3.clientHeight, i3 = window.getComputedStyle(t3).overflowY, n3 = i3.indexOf("hidden") !== -1, s3 = i3.indexOf("visible") !== -1;
    return e3 && !n3 && !s3;
  };
  var i = function(t3, n3 = void 0) {
    return !(!t3 || t3 === document.body || n3 && t3 === n3) && (e(t3) ? t3 : i(t3.parentElement, n3));
  };
  var n = function(t3) {
    var e3 = new DOMParser().parseFromString(t3, "text/html").body;
    if (e3.childElementCount > 1) {
      for (var i3 = document.createElement("div"); e3.firstChild; )
        i3.appendChild(e3.firstChild);
      return i3;
    }
    return e3.firstChild;
  };
  var s = (t3) => `${t3 || ""}`.split(" ").filter((t4) => !!t4);
  var o = (t3, e3, i3) => {
    t3 && s(e3).forEach((e4) => {
      t3.classList.toggle(e4, i3 || false);
    });
  };
  var a = class {
    constructor(t3) {
      Object.defineProperty(this, "pageX", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "pageY", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "clientX", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "clientY", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "id", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "time", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "nativePointer", { enumerable: true, configurable: true, writable: true, value: void 0 }), this.nativePointer = t3, this.pageX = t3.pageX, this.pageY = t3.pageY, this.clientX = t3.clientX, this.clientY = t3.clientY, this.id = self.Touch && t3 instanceof Touch ? t3.identifier : -1, this.time = Date.now();
    }
  };
  var r = { passive: false };
  var l = class {
    constructor(t3, { start: e3 = () => true, move: i3 = () => {
    }, end: n3 = () => {
    } }) {
      Object.defineProperty(this, "element", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "startCallback", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "moveCallback", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "endCallback", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "currentPointers", { enumerable: true, configurable: true, writable: true, value: [] }), Object.defineProperty(this, "startPointers", { enumerable: true, configurable: true, writable: true, value: [] }), this.element = t3, this.startCallback = e3, this.moveCallback = i3, this.endCallback = n3;
      for (const t4 of ["onPointerStart", "onTouchStart", "onMove", "onTouchEnd", "onPointerEnd", "onWindowBlur"])
        this[t4] = this[t4].bind(this);
      this.element.addEventListener("mousedown", this.onPointerStart, r), this.element.addEventListener("touchstart", this.onTouchStart, r), this.element.addEventListener("touchmove", this.onMove, r), this.element.addEventListener("touchend", this.onTouchEnd), this.element.addEventListener("touchcancel", this.onTouchEnd);
    }
    onPointerStart(t3) {
      if (!t3.buttons || t3.button !== 0)
        return;
      const e3 = new a(t3);
      this.currentPointers.some((t4) => t4.id === e3.id) || this.triggerPointerStart(e3, t3) && (window.addEventListener("mousemove", this.onMove), window.addEventListener("mouseup", this.onPointerEnd), window.addEventListener("blur", this.onWindowBlur));
    }
    onTouchStart(t3) {
      for (const e3 of Array.from(t3.changedTouches || []))
        this.triggerPointerStart(new a(e3), t3);
      window.addEventListener("blur", this.onWindowBlur);
    }
    onMove(t3) {
      const e3 = this.currentPointers.slice(), i3 = "changedTouches" in t3 ? Array.from(t3.changedTouches || []).map((t4) => new a(t4)) : [new a(t3)], n3 = [];
      for (const t4 of i3) {
        const e4 = this.currentPointers.findIndex((e5) => e5.id === t4.id);
        e4 < 0 || (n3.push(t4), this.currentPointers[e4] = t4);
      }
      n3.length && this.moveCallback(t3, this.currentPointers.slice(), e3);
    }
    onPointerEnd(t3) {
      t3.buttons > 0 && t3.button !== 0 || (this.triggerPointerEnd(t3, new a(t3)), window.removeEventListener("mousemove", this.onMove), window.removeEventListener("mouseup", this.onPointerEnd), window.removeEventListener("blur", this.onWindowBlur));
    }
    onTouchEnd(t3) {
      for (const e3 of Array.from(t3.changedTouches || []))
        this.triggerPointerEnd(t3, new a(e3));
    }
    triggerPointerStart(t3, e3) {
      return !!this.startCallback(e3, t3, this.currentPointers.slice()) && (this.currentPointers.push(t3), this.startPointers.push(t3), true);
    }
    triggerPointerEnd(t3, e3) {
      const i3 = this.currentPointers.findIndex((t4) => t4.id === e3.id);
      i3 < 0 || (this.currentPointers.splice(i3, 1), this.startPointers.splice(i3, 1), this.endCallback(t3, e3, this.currentPointers.slice()));
    }
    onWindowBlur() {
      this.clear();
    }
    clear() {
      for (; this.currentPointers.length; ) {
        const t3 = this.currentPointers[this.currentPointers.length - 1];
        this.currentPointers.splice(this.currentPointers.length - 1, 1), this.startPointers.splice(this.currentPointers.length - 1, 1), this.endCallback(new Event("touchend", { bubbles: true, cancelable: true, clientX: t3.clientX, clientY: t3.clientY }), t3, this.currentPointers.slice());
      }
    }
    stop() {
      this.element.removeEventListener("mousedown", this.onPointerStart, r), this.element.removeEventListener("touchstart", this.onTouchStart, r), this.element.removeEventListener("touchmove", this.onMove, r), this.element.removeEventListener("touchend", this.onTouchEnd), this.element.removeEventListener("touchcancel", this.onTouchEnd), window.removeEventListener("mousemove", this.onMove), window.removeEventListener("mouseup", this.onPointerEnd), window.removeEventListener("blur", this.onWindowBlur);
    }
  };
  function c(t3, e3) {
    return e3 ? Math.sqrt(Math.pow(e3.clientX - t3.clientX, 2) + Math.pow(e3.clientY - t3.clientY, 2)) : 0;
  }
  function h(t3, e3) {
    return e3 ? { clientX: (t3.clientX + e3.clientX) / 2, clientY: (t3.clientY + e3.clientY) / 2 } : t3;
  }
  var d = (t3) => typeof t3 == "object" && t3 !== null && t3.constructor === Object && Object.prototype.toString.call(t3) === "[object Object]";
  var u = (t3, ...e3) => {
    const i3 = e3.length;
    for (let n3 = 0; n3 < i3; n3++) {
      const i4 = e3[n3] || {};
      Object.entries(i4).forEach(([e4, i5]) => {
        const n4 = Array.isArray(i5) ? [] : {};
        t3[e4] || Object.assign(t3, { [e4]: n4 }), d(i5) ? Object.assign(t3[e4], u(n4, i5)) : Array.isArray(i5) ? Object.assign(t3, { [e4]: [...i5] }) : Object.assign(t3, { [e4]: i5 });
      });
    }
    return t3;
  };
  var p = function(t3, e3) {
    return t3.split(".").reduce((t4, e4) => typeof t4 == "object" ? t4[e4] : void 0, e3);
  };
  var f = class {
    constructor(t3 = {}) {
      Object.defineProperty(this, "options", { enumerable: true, configurable: true, writable: true, value: t3 }), Object.defineProperty(this, "events", { enumerable: true, configurable: true, writable: true, value: new Map() }), this.setOptions(t3);
      for (const t4 of Object.getOwnPropertyNames(Object.getPrototypeOf(this)))
        t4.startsWith("on") && typeof this[t4] == "function" && (this[t4] = this[t4].bind(this));
    }
    setOptions(t3) {
      this.options = t3 ? u({}, this.constructor.defaults, t3) : {};
      for (const [t4, e3] of Object.entries(this.option("on") || {}))
        this.on(t4, e3);
    }
    option(t3, ...e3) {
      let i3 = p(t3, this.options);
      return i3 && typeof i3 == "function" && (i3 = i3.call(this, this, ...e3)), i3;
    }
    optionFor(t3, e3, i3, ...n3) {
      let s3 = p(e3, t3);
      var o3;
      typeof (o3 = s3) != "string" || isNaN(o3) || isNaN(parseFloat(o3)) || (s3 = parseFloat(s3)), s3 === "true" && (s3 = true), s3 === "false" && (s3 = false), s3 && typeof s3 == "function" && (s3 = s3.call(this, this, t3, ...n3));
      let a3 = p(e3, this.options);
      return a3 && typeof a3 == "function" ? s3 = a3.call(this, this, t3, ...n3, s3) : s3 === void 0 && (s3 = a3), s3 === void 0 ? i3 : s3;
    }
    cn(t3) {
      const e3 = this.options.classes;
      return e3 && e3[t3] || "";
    }
    localize(t3, e3 = []) {
      t3 = String(t3).replace(/\{\{(\w+).?(\w+)?\}\}/g, (t4, e4, i3) => {
        let n3 = "";
        return i3 ? n3 = this.option(`${e4[0] + e4.toLowerCase().substring(1)}.l10n.${i3}`) : e4 && (n3 = this.option(`l10n.${e4}`)), n3 || (n3 = t4), n3;
      });
      for (let i3 = 0; i3 < e3.length; i3++)
        t3 = t3.split(e3[i3][0]).join(e3[i3][1]);
      return t3 = t3.replace(/\{\{(.*?)\}\}/g, (t4, e4) => e4);
    }
    on(t3, e3) {
      let i3 = [];
      typeof t3 == "string" ? i3 = t3.split(" ") : Array.isArray(t3) && (i3 = t3), this.events || (this.events = new Map()), i3.forEach((t4) => {
        let i4 = this.events.get(t4);
        i4 || (this.events.set(t4, []), i4 = []), i4.includes(e3) || i4.push(e3), this.events.set(t4, i4);
      });
    }
    off(t3, e3) {
      let i3 = [];
      typeof t3 == "string" ? i3 = t3.split(" ") : Array.isArray(t3) && (i3 = t3), i3.forEach((t4) => {
        const i4 = this.events.get(t4);
        if (Array.isArray(i4)) {
          const t5 = i4.indexOf(e3);
          t5 > -1 && i4.splice(t5, 1);
        }
      });
    }
    emit(t3, ...e3) {
      [...this.events.get(t3) || []].forEach((t4) => t4(this, ...e3)), t3 !== "*" && this.emit("*", t3, ...e3);
    }
  };
  Object.defineProperty(f, "version", { enumerable: true, configurable: true, writable: true, value: "5.0.33" }), Object.defineProperty(f, "defaults", { enumerable: true, configurable: true, writable: true, value: {} });
  var g = class extends f {
    constructor(t3 = {}) {
      super(t3), Object.defineProperty(this, "plugins", { enumerable: true, configurable: true, writable: true, value: {} });
    }
    attachPlugins(t3 = {}) {
      const e3 = new Map();
      for (const [i3, n3] of Object.entries(t3)) {
        const t4 = this.option(i3), s3 = this.plugins[i3];
        s3 || t4 === false ? s3 && t4 === false && (s3.detach(), delete this.plugins[i3]) : e3.set(i3, new n3(this, t4 || {}));
      }
      for (const [t4, i3] of e3)
        this.plugins[t4] = i3, i3.attach();
    }
    detachPlugins(t3) {
      t3 = t3 || Object.keys(this.plugins);
      for (const e3 of t3) {
        const t4 = this.plugins[e3];
        t4 && t4.detach(), delete this.plugins[e3];
      }
      return this.emit("detachPlugins"), this;
    }
  };
  var m;
  !function(t3) {
    t3[t3.Init = 0] = "Init", t3[t3.Error = 1] = "Error", t3[t3.Ready = 2] = "Ready", t3[t3.Panning = 3] = "Panning", t3[t3.Mousemove = 4] = "Mousemove", t3[t3.Destroy = 5] = "Destroy";
  }(m || (m = {}));
  var v = ["a", "b", "c", "d", "e", "f"];
  var b = { PANUP: "Move up", PANDOWN: "Move down", PANLEFT: "Move left", PANRIGHT: "Move right", ZOOMIN: "Zoom in", ZOOMOUT: "Zoom out", TOGGLEZOOM: "Toggle zoom level", TOGGLE1TO1: "Toggle zoom level", ITERATEZOOM: "Toggle zoom level", ROTATECCW: "Rotate counterclockwise", ROTATECW: "Rotate clockwise", FLIPX: "Flip horizontally", FLIPY: "Flip vertically", FITX: "Fit horizontally", FITY: "Fit vertically", RESET: "Reset", TOGGLEFS: "Toggle fullscreen" };
  var y = { content: null, width: "auto", height: "auto", panMode: "drag", touch: true, dragMinThreshold: 3, lockAxis: false, mouseMoveFactor: 1, mouseMoveFriction: 0.12, zoom: true, pinchToZoom: true, panOnlyZoomed: "auto", minScale: 1, maxScale: 2, friction: 0.25, dragFriction: 0.35, decelFriction: 0.05, click: "toggleZoom", dblClick: false, wheel: "zoom", wheelLimit: 7, spinner: true, bounds: "auto", infinite: false, rubberband: true, bounce: true, maxVelocity: 75, transformParent: false, classes: { content: "f-panzoom__content", isLoading: "is-loading", canZoomIn: "can-zoom_in", canZoomOut: "can-zoom_out", isDraggable: "is-draggable", isDragging: "is-dragging", inFullscreen: "in-fullscreen", htmlHasFullscreen: "with-panzoom-in-fullscreen" }, l10n: b };
  var w = '<circle cx="25" cy="25" r="20"></circle>';
  var x = '<div class="f-spinner"><svg viewBox="0 0 50 50">' + w + w + "</svg></div>";
  var E = (t3) => t3 && t3 !== null && t3 instanceof Element && "nodeType" in t3;
  var S = (t3, e3) => {
    t3 && s(e3).forEach((e4) => {
      t3.classList.remove(e4);
    });
  };
  var P = (t3, e3) => {
    t3 && s(e3).forEach((e4) => {
      t3.classList.add(e4);
    });
  };
  var C = { a: 1, b: 0, c: 0, d: 1, e: 0, f: 0 };
  var T = 1e5;
  var M = 1e4;
  var O = "mousemove";
  var A = "drag";
  var L = "content";
  var z = null;
  var R = null;
  var k = class extends g {
    get fits() {
      return this.contentRect.width - this.contentRect.fitWidth < 1 && this.contentRect.height - this.contentRect.fitHeight < 1;
    }
    get isTouchDevice() {
      return R === null && (R = window.matchMedia("(hover: none)").matches), R;
    }
    get isMobile() {
      return z === null && (z = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)), z;
    }
    get panMode() {
      return this.options.panMode !== O || this.isTouchDevice ? A : O;
    }
    get panOnlyZoomed() {
      const t3 = this.options.panOnlyZoomed;
      return t3 === "auto" ? this.isTouchDevice : t3;
    }
    get isInfinite() {
      return this.option("infinite");
    }
    get angle() {
      return 180 * Math.atan2(this.current.b, this.current.a) / Math.PI || 0;
    }
    get targetAngle() {
      return 180 * Math.atan2(this.target.b, this.target.a) / Math.PI || 0;
    }
    get scale() {
      const { a: t3, b: e3 } = this.current;
      return Math.sqrt(t3 * t3 + e3 * e3) || 1;
    }
    get targetScale() {
      const { a: t3, b: e3 } = this.target;
      return Math.sqrt(t3 * t3 + e3 * e3) || 1;
    }
    get minScale() {
      return this.option("minScale") || 1;
    }
    get fullScale() {
      const { contentRect: t3 } = this;
      return t3.fullWidth / t3.fitWidth || 1;
    }
    get maxScale() {
      return this.fullScale * (this.option("maxScale") || 1) || 1;
    }
    get coverScale() {
      const { containerRect: t3, contentRect: e3 } = this, i3 = Math.max(t3.height / e3.fitHeight, t3.width / e3.fitWidth) || 1;
      return Math.min(this.fullScale, i3);
    }
    get isScaling() {
      return Math.abs(this.targetScale - this.scale) > 1e-5 && !this.isResting;
    }
    get isContentLoading() {
      const t3 = this.content;
      return !!(t3 && t3 instanceof HTMLImageElement) && !t3.complete;
    }
    get isResting() {
      if (this.isBouncingX || this.isBouncingY)
        return false;
      for (const t3 of v) {
        const e3 = t3 == "e" || t3 === "f" ? 1e-4 : 1e-5;
        if (Math.abs(this.target[t3] - this.current[t3]) > e3)
          return false;
      }
      return !(!this.ignoreBounds && !this.checkBounds().inBounds);
    }
    constructor(t3, e3 = {}, i3 = {}) {
      var s3;
      if (super(e3), Object.defineProperty(this, "pointerTracker", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "resizeObserver", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "updateTimer", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "clickTimer", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "rAF", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "isTicking", { enumerable: true, configurable: true, writable: true, value: false }), Object.defineProperty(this, "ignoreBounds", { enumerable: true, configurable: true, writable: true, value: false }), Object.defineProperty(this, "isBouncingX", { enumerable: true, configurable: true, writable: true, value: false }), Object.defineProperty(this, "isBouncingY", { enumerable: true, configurable: true, writable: true, value: false }), Object.defineProperty(this, "clicks", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "trackingPoints", { enumerable: true, configurable: true, writable: true, value: [] }), Object.defineProperty(this, "pwt", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "cwd", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "pmme", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "friction", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "state", { enumerable: true, configurable: true, writable: true, value: m.Init }), Object.defineProperty(this, "isDragging", { enumerable: true, configurable: true, writable: true, value: false }), Object.defineProperty(this, "container", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "content", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "spinner", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "containerRect", { enumerable: true, configurable: true, writable: true, value: { width: 0, height: 0, innerWidth: 0, innerHeight: 0 } }), Object.defineProperty(this, "contentRect", { enumerable: true, configurable: true, writable: true, value: { top: 0, right: 0, bottom: 0, left: 0, fullWidth: 0, fullHeight: 0, fitWidth: 0, fitHeight: 0, width: 0, height: 0 } }), Object.defineProperty(this, "dragStart", { enumerable: true, configurable: true, writable: true, value: { x: 0, y: 0, top: 0, left: 0, time: 0 } }), Object.defineProperty(this, "dragOffset", { enumerable: true, configurable: true, writable: true, value: { x: 0, y: 0, time: 0 } }), Object.defineProperty(this, "current", { enumerable: true, configurable: true, writable: true, value: Object.assign({}, C) }), Object.defineProperty(this, "target", { enumerable: true, configurable: true, writable: true, value: Object.assign({}, C) }), Object.defineProperty(this, "velocity", { enumerable: true, configurable: true, writable: true, value: { a: 0, b: 0, c: 0, d: 0, e: 0, f: 0 } }), Object.defineProperty(this, "lockedAxis", { enumerable: true, configurable: true, writable: true, value: false }), !t3)
        throw new Error("Container Element Not Found");
      this.container = t3, this.initContent(), this.attachPlugins(Object.assign(Object.assign({}, k.Plugins), i3)), this.emit("attachPlugins"), this.emit("init");
      const o3 = this.content;
      if (o3.addEventListener("load", this.onLoad), o3.addEventListener("error", this.onError), this.isContentLoading) {
        if (this.option("spinner")) {
          t3.classList.add(this.cn("isLoading"));
          const e4 = n(x);
          !t3.contains(o3) || o3.parentElement instanceof HTMLPictureElement ? this.spinner = t3.appendChild(e4) : this.spinner = ((s3 = o3.parentElement) === null || s3 === void 0 ? void 0 : s3.insertBefore(e4, o3)) || null;
        }
        this.emit("beforeLoad");
      } else
        queueMicrotask(() => {
          this.enable();
        });
    }
    initContent() {
      const { container: t3 } = this, e3 = this.cn(L);
      let i3 = this.option(L) || t3.querySelector(`.${e3}`);
      if (i3 || (i3 = t3.querySelector("img,picture") || t3.firstElementChild, i3 && P(i3, e3)), i3 instanceof HTMLPictureElement && (i3 = i3.querySelector("img")), !i3)
        throw new Error("No content found");
      this.content = i3;
    }
    onLoad() {
      const { spinner: t3, container: e3, state: i3 } = this;
      t3 && (t3.remove(), this.spinner = null), this.option("spinner") && e3.classList.remove(this.cn("isLoading")), this.emit("afterLoad"), i3 === m.Init ? this.enable() : this.updateMetrics();
    }
    onError() {
      this.state !== m.Destroy && (this.spinner && (this.spinner.remove(), this.spinner = null), this.stop(), this.detachEvents(), this.state = m.Error, this.emit("error"));
    }
    getNextScale(t3) {
      const { fullScale: e3, targetScale: i3, coverScale: n3, maxScale: s3, minScale: o3 } = this;
      let a3 = o3;
      switch (t3) {
        case "toggleMax":
          a3 = i3 - o3 < 0.5 * (s3 - o3) ? s3 : o3;
          break;
        case "toggleCover":
          a3 = i3 - o3 < 0.5 * (n3 - o3) ? n3 : o3;
          break;
        case "toggleZoom":
          a3 = i3 - o3 < 0.5 * (e3 - o3) ? e3 : o3;
          break;
        case "iterateZoom":
          let t4 = [1, e3, s3].sort((t5, e4) => t5 - e4), r3 = t4.findIndex((t5) => t5 > i3 + 1e-5);
          a3 = t4[r3] || 1;
      }
      return a3;
    }
    attachObserver() {
      var t3;
      const e3 = () => {
        const { container: t4, containerRect: e4 } = this;
        return Math.abs(e4.width - t4.getBoundingClientRect().width) > 0.1 || Math.abs(e4.height - t4.getBoundingClientRect().height) > 0.1;
      };
      this.resizeObserver || window.ResizeObserver === void 0 || (this.resizeObserver = new ResizeObserver(() => {
        this.updateTimer || (e3() ? (this.onResize(), this.isMobile && (this.updateTimer = setTimeout(() => {
          e3() && this.onResize(), this.updateTimer = null;
        }, 500))) : this.updateTimer && (clearTimeout(this.updateTimer), this.updateTimer = null));
      })), (t3 = this.resizeObserver) === null || t3 === void 0 || t3.observe(this.container);
    }
    detachObserver() {
      var t3;
      (t3 = this.resizeObserver) === null || t3 === void 0 || t3.disconnect();
    }
    attachEvents() {
      const { container: t3 } = this;
      t3.addEventListener("click", this.onClick, { passive: false, capture: false }), t3.addEventListener("wheel", this.onWheel, { passive: false }), this.pointerTracker = new l(t3, { start: this.onPointerDown, move: this.onPointerMove, end: this.onPointerUp }), document.addEventListener(O, this.onMouseMove);
    }
    detachEvents() {
      var t3;
      const { container: e3 } = this;
      e3.removeEventListener("click", this.onClick, { passive: false, capture: false }), e3.removeEventListener("wheel", this.onWheel, { passive: false }), (t3 = this.pointerTracker) === null || t3 === void 0 || t3.stop(), this.pointerTracker = null, document.removeEventListener(O, this.onMouseMove), document.removeEventListener("keydown", this.onKeydown, true), this.clickTimer && (clearTimeout(this.clickTimer), this.clickTimer = null), this.updateTimer && (clearTimeout(this.updateTimer), this.updateTimer = null);
    }
    animate() {
      this.setTargetForce();
      const t3 = this.friction, e3 = this.option("maxVelocity");
      for (const i3 of v)
        t3 ? (this.velocity[i3] *= 1 - t3, e3 && !this.isScaling && (this.velocity[i3] = Math.max(Math.min(this.velocity[i3], e3), -1 * e3)), this.current[i3] += this.velocity[i3]) : this.current[i3] = this.target[i3];
      this.setTransform(), this.setEdgeForce(), !this.isResting || this.isDragging ? this.rAF = requestAnimationFrame(() => this.animate()) : this.stop("current");
    }
    setTargetForce() {
      for (const t3 of v)
        t3 === "e" && this.isBouncingX || t3 === "f" && this.isBouncingY || (this.velocity[t3] = (1 / (1 - this.friction) - 1) * (this.target[t3] - this.current[t3]));
    }
    checkBounds(t3 = 0, e3 = 0) {
      const { current: i3 } = this, n3 = i3.e + t3, s3 = i3.f + e3, o3 = this.getBounds(), { x: a3, y: r3 } = o3, l3 = a3.min, c3 = a3.max, h3 = r3.min, d3 = r3.max;
      let u3 = 0, p3 = 0;
      return l3 !== 1 / 0 && n3 < l3 ? u3 = l3 - n3 : c3 !== 1 / 0 && n3 > c3 && (u3 = c3 - n3), h3 !== 1 / 0 && s3 < h3 ? p3 = h3 - s3 : d3 !== 1 / 0 && s3 > d3 && (p3 = d3 - s3), Math.abs(u3) < 1e-4 && (u3 = 0), Math.abs(p3) < 1e-4 && (p3 = 0), Object.assign(Object.assign({}, o3), { xDiff: u3, yDiff: p3, inBounds: !u3 && !p3 });
    }
    clampTargetBounds() {
      const { target: t3 } = this, { x: e3, y: i3 } = this.getBounds();
      e3.min !== 1 / 0 && (t3.e = Math.max(t3.e, e3.min)), e3.max !== 1 / 0 && (t3.e = Math.min(t3.e, e3.max)), i3.min !== 1 / 0 && (t3.f = Math.max(t3.f, i3.min)), i3.max !== 1 / 0 && (t3.f = Math.min(t3.f, i3.max));
    }
    calculateContentDim(t3 = this.current) {
      const { content: e3, contentRect: i3 } = this, { fitWidth: n3, fitHeight: s3, fullWidth: o3, fullHeight: a3 } = i3;
      let r3 = o3, l3 = a3;
      if (this.option("zoom") || this.angle !== 0) {
        const i4 = !(e3 instanceof HTMLImageElement) && (window.getComputedStyle(e3).maxWidth === "none" || window.getComputedStyle(e3).maxHeight === "none"), c3 = i4 ? o3 : n3, h3 = i4 ? a3 : s3, d3 = this.getMatrix(t3), u3 = new DOMPoint(0, 0).matrixTransform(d3), p3 = new DOMPoint(0 + c3, 0).matrixTransform(d3), f3 = new DOMPoint(0 + c3, 0 + h3).matrixTransform(d3), g3 = new DOMPoint(0, 0 + h3).matrixTransform(d3), m2 = Math.abs(f3.x - u3.x), v2 = Math.abs(f3.y - u3.y), b3 = Math.abs(g3.x - p3.x), y2 = Math.abs(g3.y - p3.y);
        r3 = Math.max(m2, b3), l3 = Math.max(v2, y2);
      }
      return { contentWidth: r3, contentHeight: l3 };
    }
    setEdgeForce() {
      if (this.ignoreBounds || this.isDragging || this.panMode === O || this.targetScale < this.scale)
        return this.isBouncingX = false, void (this.isBouncingY = false);
      const { target: t3 } = this, { x: e3, y: i3, xDiff: n3, yDiff: s3 } = this.checkBounds();
      const o3 = this.option("maxVelocity");
      let a3 = this.velocity.e, r3 = this.velocity.f;
      n3 !== 0 ? (this.isBouncingX = true, n3 * a3 <= 0 ? a3 += 0.14 * n3 : (a3 = 0.14 * n3, e3.min !== 1 / 0 && (this.target.e = Math.max(t3.e, e3.min)), e3.max !== 1 / 0 && (this.target.e = Math.min(t3.e, e3.max))), o3 && (a3 = Math.max(Math.min(a3, o3), -1 * o3))) : this.isBouncingX = false, s3 !== 0 ? (this.isBouncingY = true, s3 * r3 <= 0 ? r3 += 0.14 * s3 : (r3 = 0.14 * s3, i3.min !== 1 / 0 && (this.target.f = Math.max(t3.f, i3.min)), i3.max !== 1 / 0 && (this.target.f = Math.min(t3.f, i3.max))), o3 && (r3 = Math.max(Math.min(r3, o3), -1 * o3))) : this.isBouncingY = false, this.isBouncingX && (this.velocity.e = a3), this.isBouncingY && (this.velocity.f = r3);
    }
    enable() {
      const { content: t3 } = this, e3 = new DOMMatrixReadOnly(window.getComputedStyle(t3).transform);
      for (const t4 of v)
        this.current[t4] = this.target[t4] = e3[t4];
      this.updateMetrics(), this.attachObserver(), this.attachEvents(), this.state = m.Ready, this.emit("ready");
    }
    onClick(t3) {
      var e3;
      t3.type === "click" && t3.detail === 0 && (this.dragOffset.x = 0, this.dragOffset.y = 0), this.isDragging && ((e3 = this.pointerTracker) === null || e3 === void 0 || e3.clear(), this.trackingPoints = [], this.startDecelAnim());
      const i3 = t3.target;
      if (!i3 || t3.defaultPrevented)
        return;
      if (i3.hasAttribute("disabled"))
        return t3.preventDefault(), void t3.stopPropagation();
      if ((() => {
        const t4 = window.getSelection();
        return t4 && t4.type === "Range";
      })() && !i3.closest("button"))
        return;
      const n3 = i3.closest("[data-panzoom-action]"), s3 = i3.closest("[data-panzoom-change]"), o3 = n3 || s3, a3 = o3 && E(o3) ? o3.dataset : null;
      if (a3) {
        const e4 = a3.panzoomChange, i4 = a3.panzoomAction;
        if ((e4 || i4) && t3.preventDefault(), e4) {
          let t4 = {};
          try {
            t4 = JSON.parse(e4);
          } catch (t5) {
            console && console.warn("The given data was not valid JSON");
          }
          return void this.applyChange(t4);
        }
        if (i4)
          return void (this[i4] && this[i4]());
      }
      if (Math.abs(this.dragOffset.x) > 3 || Math.abs(this.dragOffset.y) > 3)
        return t3.preventDefault(), void t3.stopPropagation();
      if (i3.closest("[data-fancybox]"))
        return;
      const r3 = this.content.getBoundingClientRect(), l3 = this.dragStart;
      if (l3.time && !this.canZoomOut() && (Math.abs(r3.x - l3.x) > 2 || Math.abs(r3.y - l3.y) > 2))
        return;
      this.dragStart.time = 0;
      const c3 = (e4) => {
        this.option("zoom", t3) && e4 && typeof e4 == "string" && /(iterateZoom)|(toggle(Zoom|Full|Cover|Max)|(zoomTo(Fit|Cover|Max)))/.test(e4) && typeof this[e4] == "function" && (t3.preventDefault(), this[e4]({ event: t3 }));
      }, h3 = this.option("click", t3), d3 = this.option("dblClick", t3);
      d3 ? (this.clicks++, this.clicks == 1 && (this.clickTimer = setTimeout(() => {
        this.clicks === 1 ? (this.emit("click", t3), !t3.defaultPrevented && h3 && c3(h3)) : (this.emit("dblClick", t3), t3.defaultPrevented || c3(d3)), this.clicks = 0, this.clickTimer = null;
      }, 350))) : (this.emit("click", t3), !t3.defaultPrevented && h3 && c3(h3));
    }
    addTrackingPoint(t3) {
      const e3 = this.trackingPoints.filter((t4) => t4.time > Date.now() - 100);
      e3.push(t3), this.trackingPoints = e3;
    }
    onPointerDown(t3, e3, i3) {
      var n3;
      if (this.option("touch", t3) === false)
        return false;
      this.pwt = 0, this.dragOffset = { x: 0, y: 0, time: 0 }, this.trackingPoints = [];
      const s3 = this.content.getBoundingClientRect();
      if (this.dragStart = { x: s3.x, y: s3.y, top: s3.top, left: s3.left, time: Date.now() }, this.clickTimer)
        return false;
      if (this.panMode === O && this.targetScale > 1)
        return t3.preventDefault(), t3.stopPropagation(), false;
      const o3 = t3.composedPath()[0];
      if (!i3.length) {
        if (["TEXTAREA", "OPTION", "INPUT", "SELECT", "VIDEO", "IFRAME"].includes(o3.nodeName) || o3.closest("[contenteditable],[data-selectable],[data-draggable],[data-clickable],[data-panzoom-change],[data-panzoom-action]"))
          return false;
        (n3 = window.getSelection()) === null || n3 === void 0 || n3.removeAllRanges();
      }
      if (t3.type === "mousedown")
        ["A", "BUTTON"].includes(o3.nodeName) || t3.preventDefault();
      else if (Math.abs(this.velocity.a) > 0.3)
        return false;
      return this.target.e = this.current.e, this.target.f = this.current.f, this.stop(), this.isDragging || (this.isDragging = true, this.addTrackingPoint(e3), this.emit("touchStart", t3)), true;
    }
    onPointerMove(e3, n3, s3) {
      if (this.option("touch", e3) === false)
        return;
      if (!this.isDragging)
        return;
      if (n3.length < 2 && this.panOnlyZoomed && t(this.targetScale) <= t(this.minScale))
        return;
      if (this.emit("touchMove", e3), e3.defaultPrevented)
        return;
      this.addTrackingPoint(n3[0]);
      const { content: o3 } = this, a3 = h(s3[0], s3[1]), r3 = h(n3[0], n3[1]);
      let l3 = 0, d3 = 0;
      if (n3.length > 1) {
        const t3 = o3.getBoundingClientRect();
        l3 = a3.clientX - t3.left - 0.5 * t3.width, d3 = a3.clientY - t3.top - 0.5 * t3.height;
      }
      const u3 = c(s3[0], s3[1]), p3 = c(n3[0], n3[1]);
      let f3 = u3 ? p3 / u3 : 1, g3 = r3.clientX - a3.clientX, m2 = r3.clientY - a3.clientY;
      this.dragOffset.x += g3, this.dragOffset.y += m2, this.dragOffset.time = Date.now() - this.dragStart.time;
      let v2 = t(this.targetScale) === t(this.minScale) && this.option("lockAxis");
      if (v2 && !this.lockedAxis)
        if (v2 === "xy" || v2 === "y" || e3.type === "touchmove") {
          if (Math.abs(this.dragOffset.x) < 6 && Math.abs(this.dragOffset.y) < 6)
            return void e3.preventDefault();
          const t3 = Math.abs(180 * Math.atan2(this.dragOffset.y, this.dragOffset.x) / Math.PI);
          this.lockedAxis = t3 > 45 && t3 < 135 ? "y" : "x", this.dragOffset.x = 0, this.dragOffset.y = 0, g3 = 0, m2 = 0;
        } else
          this.lockedAxis = v2;
      if (i(e3.target, this.content) && (v2 = "x", this.dragOffset.y = 0), v2 && v2 !== "xy" && this.lockedAxis !== v2 && t(this.targetScale) === t(this.minScale))
        return;
      e3.cancelable && e3.preventDefault(), this.container.classList.add(this.cn("isDragging"));
      const b3 = this.checkBounds(g3, m2);
      this.option("rubberband") ? (this.isInfinite !== "x" && (b3.xDiff > 0 && g3 < 0 || b3.xDiff < 0 && g3 > 0) && (g3 *= Math.max(0, 0.5 - Math.abs(0.75 / this.contentRect.fitWidth * b3.xDiff))), this.isInfinite !== "y" && (b3.yDiff > 0 && m2 < 0 || b3.yDiff < 0 && m2 > 0) && (m2 *= Math.max(0, 0.5 - Math.abs(0.75 / this.contentRect.fitHeight * b3.yDiff)))) : (b3.xDiff && (g3 = 0), b3.yDiff && (m2 = 0));
      const y2 = this.targetScale, w2 = this.minScale, x2 = this.maxScale;
      y2 < 0.5 * w2 && (f3 = Math.max(f3, w2)), y2 > 1.5 * x2 && (f3 = Math.min(f3, x2)), this.lockedAxis === "y" && t(y2) === t(w2) && (g3 = 0), this.lockedAxis === "x" && t(y2) === t(w2) && (m2 = 0), this.applyChange({ originX: l3, originY: d3, panX: g3, panY: m2, scale: f3, friction: this.option("dragFriction"), ignoreBounds: true });
    }
    onPointerUp(t3, e3, n3) {
      if (n3.length)
        return this.dragOffset.x = 0, this.dragOffset.y = 0, void (this.trackingPoints = []);
      this.container.classList.remove(this.cn("isDragging")), this.isDragging && (this.addTrackingPoint(e3), this.panOnlyZoomed && this.contentRect.width - this.contentRect.fitWidth < 1 && this.contentRect.height - this.contentRect.fitHeight < 1 && (this.trackingPoints = []), i(t3.target, this.content) && this.lockedAxis === "y" && (this.trackingPoints = []), this.emit("touchEnd", t3), this.isDragging = false, this.lockedAxis = false, this.state !== m.Destroy && (t3.defaultPrevented || this.startDecelAnim()));
    }
    startDecelAnim() {
      var e3;
      const i3 = this.isScaling;
      this.rAF && (cancelAnimationFrame(this.rAF), this.rAF = null), this.isBouncingX = false, this.isBouncingY = false;
      for (const t3 of v)
        this.velocity[t3] = 0;
      this.target.e = this.current.e, this.target.f = this.current.f, S(this.container, "is-scaling"), S(this.container, "is-animating"), this.isTicking = false;
      const { trackingPoints: n3 } = this, s3 = n3[0], o3 = n3[n3.length - 1];
      let a3 = 0, r3 = 0, l3 = 0;
      o3 && s3 && (a3 = o3.clientX - s3.clientX, r3 = o3.clientY - s3.clientY, l3 = o3.time - s3.time);
      const c3 = ((e3 = window.visualViewport) === null || e3 === void 0 ? void 0 : e3.scale) || 1;
      c3 !== 1 && (a3 *= c3, r3 *= c3);
      let h3 = 0, d3 = 0, u3 = 0, p3 = 0, f3 = this.option("decelFriction");
      const g3 = this.targetScale;
      if (l3 > 0) {
        u3 = Math.abs(a3) > 3 ? a3 / (l3 / 30) : 0, p3 = Math.abs(r3) > 3 ? r3 / (l3 / 30) : 0;
        const t3 = this.option("maxVelocity");
        t3 && (u3 = Math.max(Math.min(u3, t3), -1 * t3), p3 = Math.max(Math.min(p3, t3), -1 * t3));
      }
      u3 && (h3 = u3 / (1 / (1 - f3) - 1)), p3 && (d3 = p3 / (1 / (1 - f3) - 1)), (this.option("lockAxis") === "y" || this.option("lockAxis") === "xy" && this.lockedAxis === "y" && t(g3) === this.minScale) && (h3 = u3 = 0), (this.option("lockAxis") === "x" || this.option("lockAxis") === "xy" && this.lockedAxis === "x" && t(g3) === this.minScale) && (d3 = p3 = 0);
      const m2 = this.dragOffset.x, b3 = this.dragOffset.y, y2 = this.option("dragMinThreshold") || 0;
      Math.abs(m2) < y2 && Math.abs(b3) < y2 && (h3 = d3 = 0, u3 = p3 = 0), (this.option("zoom") && (g3 < this.minScale - 1e-5 || g3 > this.maxScale + 1e-5) || i3 && !h3 && !d3) && (f3 = 0.35), this.applyChange({ panX: h3, panY: d3, friction: f3 }), this.emit("decel", u3, p3, m2, b3);
    }
    onWheel(t3) {
      var e3 = [-t3.deltaX || 0, -t3.deltaY || 0, -t3.detail || 0].reduce(function(t4, e4) {
        return Math.abs(e4) > Math.abs(t4) ? e4 : t4;
      });
      const i3 = Math.max(-1, Math.min(1, e3));
      if (this.emit("wheel", t3, i3), this.panMode === O)
        return;
      if (t3.defaultPrevented)
        return;
      const n3 = this.option("wheel");
      n3 === "pan" ? (t3.preventDefault(), this.panOnlyZoomed && !this.canZoomOut() || this.applyChange({ panX: 2 * -t3.deltaX, panY: 2 * -t3.deltaY, bounce: false })) : n3 === "zoom" && this.option("zoom") !== false && this.zoomWithWheel(t3);
    }
    onMouseMove(t3) {
      this.panWithMouse(t3);
    }
    onKeydown(t3) {
      t3.key === "Escape" && this.toggleFS();
    }
    onResize() {
      this.updateMetrics(), this.checkBounds().inBounds || this.requestTick();
    }
    setTransform() {
      this.emit("beforeTransform");
      const { current: e3, target: i3, content: n3, contentRect: s3 } = this, o3 = Object.assign({}, C);
      for (const n4 of v) {
        const s4 = n4 == "e" || n4 === "f" ? M : T;
        o3[n4] = t(e3[n4], s4), Math.abs(i3[n4] - e3[n4]) < (n4 == "e" || n4 === "f" ? 0.51 : 1e-3) && (e3[n4] = i3[n4]);
      }
      let { a: a3, b: r3, c: l3, d: c3, e: h3, f: d3 } = o3, u3 = `matrix(${a3}, ${r3}, ${l3}, ${c3}, ${h3}, ${d3})`, p3 = n3.parentElement instanceof HTMLPictureElement ? n3.parentElement : n3;
      if (this.option("transformParent") && (p3 = p3.parentElement || p3), p3.style.transform === u3)
        return;
      p3.style.transform = u3;
      const { contentWidth: f3, contentHeight: g3 } = this.calculateContentDim();
      s3.width = f3, s3.height = g3, this.emit("afterTransform");
    }
    updateMetrics(e3 = false) {
      var i3;
      if (!this || this.state === m.Destroy)
        return;
      if (this.isContentLoading)
        return;
      const n3 = Math.max(1, ((i3 = window.visualViewport) === null || i3 === void 0 ? void 0 : i3.scale) || 1), { container: s3, content: o3 } = this, a3 = o3 instanceof HTMLImageElement, r3 = s3.getBoundingClientRect(), l3 = getComputedStyle(this.container);
      let c3 = r3.width * n3, h3 = r3.height * n3;
      const d3 = parseFloat(l3.paddingTop) + parseFloat(l3.paddingBottom), u3 = c3 - (parseFloat(l3.paddingLeft) + parseFloat(l3.paddingRight)), p3 = h3 - d3;
      this.containerRect = { width: c3, height: h3, innerWidth: u3, innerHeight: p3 };
      let f3 = this.option("width") || "auto", g3 = this.option("height") || "auto";
      f3 === "auto" && (f3 = parseFloat(o3.dataset.width || "") || ((t3) => {
        let e4 = 0;
        return e4 = t3 instanceof HTMLImageElement ? t3.naturalWidth : t3 instanceof SVGElement ? t3.width.baseVal.value : Math.max(t3.offsetWidth, t3.scrollWidth), e4 || 0;
      })(o3)), g3 === "auto" && (g3 = parseFloat(o3.dataset.height || "") || ((t3) => {
        let e4 = 0;
        return e4 = t3 instanceof HTMLImageElement ? t3.naturalHeight : t3 instanceof SVGElement ? t3.height.baseVal.value : Math.max(t3.offsetHeight, t3.scrollHeight), e4 || 0;
      })(o3));
      let v2 = o3.parentElement instanceof HTMLPictureElement ? o3.parentElement : o3;
      this.option("transformParent") && (v2 = v2.parentElement || v2);
      const b3 = v2.getAttribute("style") || "";
      v2.style.setProperty("transform", "none", "important"), a3 && (v2.style.width = "", v2.style.height = ""), v2.offsetHeight;
      const y2 = o3.getBoundingClientRect();
      let w2 = y2.width * n3, x2 = y2.height * n3, E2 = 0, S2 = 0;
      a3 && (Math.abs(f3 - w2) > 1 || Math.abs(g3 - x2) > 1) && ({ width: w2, height: x2, top: E2, left: S2 } = ((t3, e4, i4, n4) => {
        const s4 = i4 / n4;
        return s4 > t3 / e4 ? (i4 = t3, n4 = t3 / s4) : (i4 = e4 * s4, n4 = e4), { width: i4, height: n4, top: 0.5 * (e4 - n4), left: 0.5 * (t3 - i4) };
      })(w2, x2, f3, g3)), this.contentRect = Object.assign(Object.assign({}, this.contentRect), { top: y2.top - r3.top + E2, bottom: r3.bottom - y2.bottom + E2, left: y2.left - r3.left + S2, right: r3.right - y2.right + S2, fitWidth: w2, fitHeight: x2, width: w2, height: x2, fullWidth: f3, fullHeight: g3 }), v2.style.cssText = b3, a3 && (v2.style.width = `${w2}px`, v2.style.height = `${x2}px`), this.setTransform(), e3 !== true && this.emit("refresh"), this.ignoreBounds || (t(this.targetScale) < t(this.minScale) ? this.zoomTo(this.minScale, { friction: 0 }) : this.targetScale > this.maxScale ? this.zoomTo(this.maxScale, { friction: 0 }) : this.state === m.Init || this.checkBounds().inBounds || this.requestTick()), this.updateControls();
    }
    calculateBounds() {
      const { contentWidth: e3, contentHeight: i3 } = this.calculateContentDim(this.target), { targetScale: n3, lockedAxis: s3 } = this, { fitWidth: o3, fitHeight: a3 } = this.contentRect;
      let r3 = 0, l3 = 0, c3 = 0, h3 = 0;
      const d3 = this.option("infinite");
      if (d3 === true || s3 && d3 === s3)
        r3 = -1 / 0, c3 = 1 / 0, l3 = -1 / 0, h3 = 1 / 0;
      else {
        let { containerRect: s4, contentRect: d4 } = this, u3 = t(o3 * n3, M), p3 = t(a3 * n3, M), { innerWidth: f3, innerHeight: g3 } = s4;
        if (s4.width === u3 && (f3 = s4.width), s4.width === p3 && (g3 = s4.height), e3 > f3) {
          c3 = 0.5 * (e3 - f3), r3 = -1 * c3;
          let t3 = 0.5 * (d4.right - d4.left);
          r3 += t3, c3 += t3;
        }
        if (o3 > f3 && e3 < f3 && (r3 -= 0.5 * (o3 - f3), c3 -= 0.5 * (o3 - f3)), i3 > g3) {
          h3 = 0.5 * (i3 - g3), l3 = -1 * h3;
          let t3 = 0.5 * (d4.bottom - d4.top);
          l3 += t3, h3 += t3;
        }
        a3 > g3 && i3 < g3 && (r3 -= 0.5 * (a3 - g3), c3 -= 0.5 * (a3 - g3));
      }
      return { x: { min: r3, max: c3 }, y: { min: l3, max: h3 } };
    }
    getBounds() {
      const t3 = this.option("bounds");
      return t3 !== "auto" ? t3 : this.calculateBounds();
    }
    updateControls() {
      const e3 = this, i3 = e3.container, { panMode: n3, contentRect: s3, targetScale: a3, minScale: r3 } = e3;
      let l3 = r3, c3 = e3.option("click") || false;
      c3 && (l3 = e3.getNextScale(c3));
      let h3 = e3.canZoomIn(), d3 = e3.canZoomOut(), u3 = n3 === A && !!this.option("touch"), p3 = d3 && u3;
      if (u3 && (t(a3) < t(r3) && !this.panOnlyZoomed && (p3 = true), (t(s3.width, 1) > t(s3.fitWidth, 1) || t(s3.height, 1) > t(s3.fitHeight, 1)) && (p3 = true)), t(s3.width * a3, 1) < t(s3.fitWidth, 1) && (p3 = false), n3 === O && (p3 = false), o(i3, this.cn("isDraggable"), p3), !this.option("zoom"))
        return;
      let f3 = h3 && t(l3) > t(a3), g3 = !f3 && !p3 && d3 && t(l3) < t(a3);
      o(i3, this.cn("canZoomIn"), f3), o(i3, this.cn("canZoomOut"), g3);
      for (const t3 of i3.querySelectorAll("[data-panzoom-action]")) {
        let e4 = false, i4 = false;
        switch (t3.dataset.panzoomAction) {
          case "zoomIn":
            h3 ? e4 = true : i4 = true;
            break;
          case "zoomOut":
            d3 ? e4 = true : i4 = true;
            break;
          case "toggleZoom":
          case "iterateZoom":
            h3 || d3 ? e4 = true : i4 = true;
            const n4 = t3.querySelector("g");
            n4 && (n4.style.display = h3 ? "" : "none");
        }
        e4 ? (t3.removeAttribute("disabled"), t3.removeAttribute("tabindex")) : i4 && (t3.setAttribute("disabled", ""), t3.setAttribute("tabindex", "-1"));
      }
    }
    panTo({ x: t3 = this.target.e, y: e3 = this.target.f, scale: i3 = this.targetScale, friction: n3 = this.option("friction"), angle: s3 = 0, originX: o3 = 0, originY: a3 = 0, flipX: r3 = false, flipY: l3 = false, ignoreBounds: c3 = false }) {
      this.state !== m.Destroy && this.applyChange({ panX: t3 - this.target.e, panY: e3 - this.target.f, scale: i3 / this.targetScale, angle: s3, originX: o3, originY: a3, friction: n3, flipX: r3, flipY: l3, ignoreBounds: c3 });
    }
    applyChange({ panX: e3 = 0, panY: i3 = 0, scale: n3 = 1, angle: s3 = 0, originX: o3 = -this.current.e, originY: a3 = -this.current.f, friction: r3 = this.option("friction"), flipX: l3 = false, flipY: c3 = false, ignoreBounds: h3 = false, bounce: d3 = this.option("bounce") }) {
      const u3 = this.state;
      if (u3 === m.Destroy)
        return;
      this.rAF && (cancelAnimationFrame(this.rAF), this.rAF = null), this.friction = r3 || 0, this.ignoreBounds = h3;
      const { current: p3 } = this, f3 = p3.e, g3 = p3.f, b3 = this.getMatrix(this.target);
      let y2 = new DOMMatrix().translate(f3, g3).translate(o3, a3).translate(e3, i3);
      if (this.option("zoom")) {
        if (!h3) {
          const t3 = this.targetScale, e4 = this.minScale, i4 = this.maxScale;
          t3 * n3 < e4 && (n3 = e4 / t3), t3 * n3 > i4 && (n3 = i4 / t3);
        }
        y2 = y2.scale(n3);
      }
      y2 = y2.translate(-o3, -a3).translate(-f3, -g3).multiply(b3), s3 && (y2 = y2.rotate(s3)), l3 && (y2 = y2.scale(-1, 1)), c3 && (y2 = y2.scale(1, -1));
      for (const e4 of v)
        e4 !== "e" && e4 !== "f" && (y2[e4] > this.minScale + 1e-5 || y2[e4] < this.minScale - 1e-5) ? this.target[e4] = y2[e4] : this.target[e4] = t(y2[e4], M);
      (this.targetScale < this.scale || Math.abs(n3 - 1) > 0.1 || this.panMode === O || d3 === false) && !h3 && this.clampTargetBounds(), u3 === m.Init ? this.animate() : this.isResting || (this.state = m.Panning, this.requestTick());
    }
    stop(t3 = false) {
      if (this.state === m.Init || this.state === m.Destroy)
        return;
      const e3 = this.isTicking;
      this.rAF && (cancelAnimationFrame(this.rAF), this.rAF = null), this.isBouncingX = false, this.isBouncingY = false;
      for (const e4 of v)
        this.velocity[e4] = 0, t3 === "current" ? this.current[e4] = this.target[e4] : t3 === "target" && (this.target[e4] = this.current[e4]);
      this.setTransform(), S(this.container, "is-scaling"), S(this.container, "is-animating"), this.isTicking = false, this.state = m.Ready, e3 && (this.emit("endAnimation"), this.updateControls());
    }
    requestTick() {
      this.isTicking || (this.emit("startAnimation"), this.updateControls(), P(this.container, "is-animating"), this.isScaling && P(this.container, "is-scaling")), this.isTicking = true, this.rAF || (this.rAF = requestAnimationFrame(() => this.animate()));
    }
    panWithMouse(e3, i3 = this.option("mouseMoveFriction")) {
      if (this.pmme = e3, this.panMode !== O || !e3)
        return;
      if (t(this.targetScale) <= t(this.minScale))
        return;
      this.emit("mouseMove", e3);
      const { container: n3, containerRect: s3, contentRect: o3 } = this, a3 = s3.width, r3 = s3.height, l3 = n3.getBoundingClientRect(), c3 = (e3.clientX || 0) - l3.left, h3 = (e3.clientY || 0) - l3.top;
      let { contentWidth: d3, contentHeight: u3 } = this.calculateContentDim(this.target);
      const p3 = this.option("mouseMoveFactor");
      p3 > 1 && (d3 !== a3 && (d3 *= p3), u3 !== r3 && (u3 *= p3));
      let f3 = 0.5 * (d3 - a3) - c3 / a3 * 100 / 100 * (d3 - a3);
      f3 += 0.5 * (o3.right - o3.left);
      let g3 = 0.5 * (u3 - r3) - h3 / r3 * 100 / 100 * (u3 - r3);
      g3 += 0.5 * (o3.bottom - o3.top), this.applyChange({ panX: f3 - this.target.e, panY: g3 - this.target.f, friction: i3 });
    }
    zoomWithWheel(e3) {
      if (this.state === m.Destroy || this.state === m.Init)
        return;
      const i3 = Date.now();
      if (i3 - this.pwt < 45)
        return void e3.preventDefault();
      this.pwt = i3;
      var n3 = [-e3.deltaX || 0, -e3.deltaY || 0, -e3.detail || 0].reduce(function(t3, e4) {
        return Math.abs(e4) > Math.abs(t3) ? e4 : t3;
      });
      const s3 = Math.max(-1, Math.min(1, n3)), { targetScale: o3, maxScale: a3, minScale: r3 } = this;
      let l3 = o3 * (100 + 45 * s3) / 100;
      t(l3) < t(r3) && t(o3) <= t(r3) ? (this.cwd += Math.abs(s3), l3 = r3) : t(l3) > t(a3) && t(o3) >= t(a3) ? (this.cwd += Math.abs(s3), l3 = a3) : (this.cwd = 0, l3 = Math.max(Math.min(l3, a3), r3)), this.cwd > this.option("wheelLimit") || (e3.preventDefault(), t(l3) !== t(o3) && this.zoomTo(l3, { event: e3 }));
    }
    canZoomIn() {
      return this.option("zoom") && (t(this.contentRect.width, 1) < t(this.contentRect.fitWidth, 1) || t(this.targetScale) < t(this.maxScale));
    }
    canZoomOut() {
      return this.option("zoom") && t(this.targetScale) > t(this.minScale);
    }
    zoomIn(t3 = 1.25, e3) {
      this.zoomTo(this.targetScale * t3, e3);
    }
    zoomOut(t3 = 0.8, e3) {
      this.zoomTo(this.targetScale * t3, e3);
    }
    zoomToFit(t3) {
      this.zoomTo("fit", t3);
    }
    zoomToCover(t3) {
      this.zoomTo("cover", t3);
    }
    zoomToFull(t3) {
      this.zoomTo("full", t3);
    }
    zoomToMax(t3) {
      this.zoomTo("max", t3);
    }
    toggleZoom(t3) {
      this.zoomTo(this.getNextScale("toggleZoom"), t3);
    }
    toggleMax(t3) {
      this.zoomTo(this.getNextScale("toggleMax"), t3);
    }
    toggleCover(t3) {
      this.zoomTo(this.getNextScale("toggleCover"), t3);
    }
    iterateZoom(t3) {
      this.zoomTo("next", t3);
    }
    zoomTo(t3 = 1, { friction: e3 = "auto", originX: i3 = "auto", originY: n3 = "auto", event: s3 } = {}) {
      if (this.isContentLoading || this.state === m.Destroy)
        return;
      const { targetScale: o3, fullScale: a3, maxScale: r3, coverScale: l3 } = this;
      if (this.stop(), this.panMode === O && (s3 = this.pmme || s3), s3 || i3 === "auto" || n3 === "auto") {
        const t4 = this.content.getBoundingClientRect(), e4 = this.container.getBoundingClientRect(), o4 = s3 ? s3.clientX : e4.left + 0.5 * e4.width, a4 = s3 ? s3.clientY : e4.top + 0.5 * e4.height;
        i3 = o4 - t4.left - 0.5 * t4.width, n3 = a4 - t4.top - 0.5 * t4.height;
      }
      let c3 = 1;
      typeof t3 == "number" ? c3 = t3 : t3 === "full" ? c3 = a3 : t3 === "cover" ? c3 = l3 : t3 === "max" ? c3 = r3 : t3 === "fit" ? c3 = 1 : t3 === "next" && (c3 = this.getNextScale("iterateZoom")), c3 = c3 / o3 || 1, e3 = e3 === "auto" ? c3 > 1 ? 0.15 : 0.25 : e3, this.applyChange({ scale: c3, originX: i3, originY: n3, friction: e3 }), s3 && this.panMode === O && this.panWithMouse(s3, e3);
    }
    rotateCCW() {
      this.applyChange({ angle: -90 });
    }
    rotateCW() {
      this.applyChange({ angle: 90 });
    }
    flipX() {
      this.applyChange({ flipX: true });
    }
    flipY() {
      this.applyChange({ flipY: true });
    }
    fitX() {
      this.stop("target");
      const { containerRect: t3, contentRect: e3, target: i3 } = this;
      this.applyChange({ panX: 0.5 * t3.width - (e3.left + 0.5 * e3.fitWidth) - i3.e, panY: 0.5 * t3.height - (e3.top + 0.5 * e3.fitHeight) - i3.f, scale: t3.width / e3.fitWidth / this.targetScale, originX: 0, originY: 0, ignoreBounds: true });
    }
    fitY() {
      this.stop("target");
      const { containerRect: t3, contentRect: e3, target: i3 } = this;
      this.applyChange({ panX: 0.5 * t3.width - (e3.left + 0.5 * e3.fitWidth) - i3.e, panY: 0.5 * t3.innerHeight - (e3.top + 0.5 * e3.fitHeight) - i3.f, scale: t3.height / e3.fitHeight / this.targetScale, originX: 0, originY: 0, ignoreBounds: true });
    }
    toggleFS() {
      const { container: t3 } = this, e3 = this.cn("inFullscreen"), i3 = this.cn("htmlHasFullscreen");
      t3.classList.toggle(e3);
      const n3 = t3.classList.contains(e3);
      n3 ? (document.documentElement.classList.add(i3), document.addEventListener("keydown", this.onKeydown, true)) : (document.documentElement.classList.remove(i3), document.removeEventListener("keydown", this.onKeydown, true)), this.updateMetrics(), this.emit(n3 ? "enterFS" : "exitFS");
    }
    getMatrix(t3 = this.current) {
      const { a: e3, b: i3, c: n3, d: s3, e: o3, f: a3 } = t3;
      return new DOMMatrix([e3, i3, n3, s3, o3, a3]);
    }
    reset(t3) {
      if (this.state !== m.Init && this.state !== m.Destroy) {
        this.stop("current");
        for (const t4 of v)
          this.target[t4] = C[t4];
        this.target.a = this.minScale, this.target.d = this.minScale, this.clampTargetBounds(), this.isResting || (this.friction = t3 === void 0 ? this.option("friction") : t3, this.state = m.Panning, this.requestTick());
      }
    }
    destroy() {
      this.stop(), this.state = m.Destroy, this.detachEvents(), this.detachObserver();
      const { container: t3, content: e3 } = this, i3 = this.option("classes") || {};
      for (const e4 of Object.values(i3))
        t3.classList.remove(e4 + "");
      e3 && (e3.removeEventListener("load", this.onLoad), e3.removeEventListener("error", this.onError)), this.detachPlugins();
    }
  };
  Object.defineProperty(k, "defaults", { enumerable: true, configurable: true, writable: true, value: y }), Object.defineProperty(k, "Plugins", { enumerable: true, configurable: true, writable: true, value: {} });
  var I = function(t3, e3) {
    let i3 = true;
    return (...n3) => {
      i3 && (i3 = false, t3(...n3), setTimeout(() => {
        i3 = true;
      }, e3));
    };
  };
  var D = (t3, e3) => {
    let i3 = [];
    return t3.childNodes.forEach((t4) => {
      t4.nodeType !== Node.ELEMENT_NODE || e3 && !t4.matches(e3) || i3.push(t4);
    }), i3;
  };
  var F = { viewport: null, track: null, enabled: true, slides: [], axis: "x", transition: "fade", preload: 1, slidesPerPage: "auto", initialPage: 0, friction: 0.12, Panzoom: { decelFriction: 0.12 }, center: true, infinite: true, fill: true, dragFree: false, adaptiveHeight: false, direction: "ltr", classes: { container: "f-carousel", viewport: "f-carousel__viewport", track: "f-carousel__track", slide: "f-carousel__slide", isLTR: "is-ltr", isRTL: "is-rtl", isHorizontal: "is-horizontal", isVertical: "is-vertical", inTransition: "in-transition", isSelected: "is-selected" }, l10n: { NEXT: "Next slide", PREV: "Previous slide", GOTO: "Go to slide #%d" } };
  var j;
  !function(t3) {
    t3[t3.Init = 0] = "Init", t3[t3.Ready = 1] = "Ready", t3[t3.Destroy = 2] = "Destroy";
  }(j || (j = {}));
  var B = (t3) => {
    if (typeof t3 == "string" || t3 instanceof HTMLElement)
      t3 = { html: t3 };
    else {
      const e3 = t3.thumb;
      e3 !== void 0 && (typeof e3 == "string" && (t3.thumbSrc = e3), e3 instanceof HTMLImageElement && (t3.thumbEl = e3, t3.thumbElSrc = e3.src, t3.thumbSrc = e3.src), delete t3.thumb);
    }
    return Object.assign({ html: "", el: null, isDom: false, class: "", customClass: "", index: -1, dim: 0, gap: 0, pos: 0, transition: false }, t3);
  };
  var H = (t3 = {}) => Object.assign({ index: -1, slides: [], dim: 0, pos: -1 }, t3);
  var N = class extends f {
    constructor(t3, e3) {
      super(e3), Object.defineProperty(this, "instance", { enumerable: true, configurable: true, writable: true, value: t3 });
    }
    attach() {
    }
    detach() {
    }
  };
  var _ = { classes: { list: "f-carousel__dots", isDynamic: "is-dynamic", hasDots: "has-dots", dot: "f-carousel__dot", isBeforePrev: "is-before-prev", isPrev: "is-prev", isCurrent: "is-current", isNext: "is-next", isAfterNext: "is-after-next" }, dotTpl: '<button type="button" data-carousel-page="%i" aria-label="{{GOTO}}"><span class="f-carousel__dot" aria-hidden="true"></span></button>', dynamicFrom: 11, maxCount: 1 / 0, minCount: 2 };
  var $ = class extends N {
    constructor() {
      super(...arguments), Object.defineProperty(this, "isDynamic", { enumerable: true, configurable: true, writable: true, value: false }), Object.defineProperty(this, "list", { enumerable: true, configurable: true, writable: true, value: null });
    }
    onRefresh() {
      this.refresh();
    }
    build() {
      let t3 = this.list;
      if (!t3) {
        t3 = document.createElement("ul"), P(t3, this.cn("list")), t3.setAttribute("role", "tablist");
        const e3 = this.instance.container;
        e3.appendChild(t3), P(e3, this.cn("hasDots")), this.list = t3;
      }
      return t3;
    }
    refresh() {
      var t3;
      const e3 = this.instance.pages.length, i3 = Math.min(2, this.option("minCount")), n3 = Math.max(2e3, this.option("maxCount")), s3 = this.option("dynamicFrom");
      if (e3 < i3 || e3 > n3)
        return void this.cleanup();
      const a3 = typeof s3 == "number" && e3 > 5 && e3 >= s3, r3 = !this.list || this.isDynamic !== a3 || this.list.children.length !== e3;
      r3 && this.cleanup();
      const l3 = this.build();
      if (o(l3, this.cn("isDynamic"), !!a3), r3)
        for (let t4 = 0; t4 < e3; t4++)
          l3.append(this.createItem(t4));
      let c3, h3 = 0;
      for (const e4 of [...l3.children]) {
        const i4 = h3 === this.instance.page;
        i4 && (c3 = e4), o(e4, this.cn("isCurrent"), i4), (t3 = e4.children[0]) === null || t3 === void 0 || t3.setAttribute("aria-selected", i4 ? "true" : "false");
        for (const t4 of ["isBeforePrev", "isPrev", "isNext", "isAfterNext"])
          S(e4, this.cn(t4));
        h3++;
      }
      if (c3 = c3 || l3.firstChild, a3 && c3) {
        const t4 = c3.previousElementSibling, e4 = t4 && t4.previousElementSibling;
        P(t4, this.cn("isPrev")), P(e4, this.cn("isBeforePrev"));
        const i4 = c3.nextElementSibling, n4 = i4 && i4.nextElementSibling;
        P(i4, this.cn("isNext")), P(n4, this.cn("isAfterNext"));
      }
      this.isDynamic = a3;
    }
    createItem(t3 = 0) {
      var e3;
      const i3 = document.createElement("li");
      i3.setAttribute("role", "presentation");
      const s3 = n(this.instance.localize(this.option("dotTpl"), [["%d", t3 + 1]]).replace(/\%i/g, t3 + ""));
      return i3.appendChild(s3), (e3 = i3.children[0]) === null || e3 === void 0 || e3.setAttribute("role", "tab"), i3;
    }
    cleanup() {
      this.list && (this.list.remove(), this.list = null), this.isDynamic = false, S(this.instance.container, this.cn("hasDots"));
    }
    attach() {
      this.instance.on(["refresh", "change"], this.onRefresh);
    }
    detach() {
      this.instance.off(["refresh", "change"], this.onRefresh), this.cleanup();
    }
  };
  Object.defineProperty($, "defaults", { enumerable: true, configurable: true, writable: true, value: _ });
  var W = "disabled";
  var X = "next";
  var q = "prev";
  var Y = class extends N {
    constructor() {
      super(...arguments), Object.defineProperty(this, "container", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "prev", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "next", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "isDom", { enumerable: true, configurable: true, writable: true, value: false });
    }
    onRefresh() {
      const t3 = this.instance, e3 = t3.pages.length, i3 = t3.page;
      if (e3 < 2)
        return void this.cleanup();
      this.build();
      let n3 = this.prev, s3 = this.next;
      n3 && s3 && (n3.removeAttribute(W), s3.removeAttribute(W), t3.isInfinite || (i3 <= 0 && n3.setAttribute(W, ""), i3 >= e3 - 1 && s3.setAttribute(W, "")));
    }
    addBtn(t3) {
      var e3;
      const i3 = this.instance, n3 = document.createElement("button");
      n3.setAttribute("tabindex", "0"), n3.setAttribute("title", i3.localize(`{{${t3.toUpperCase()}}}`)), P(n3, this.cn("button") + " " + this.cn(t3 === X ? "isNext" : "isPrev"));
      const s3 = i3.isRTL ? t3 === X ? q : X : t3;
      var o3;
      return n3.innerHTML = i3.localize(this.option(`${s3}Tpl`)), n3.dataset[`carousel${o3 = t3, o3 ? o3.match("^[a-z]") ? o3.charAt(0).toUpperCase() + o3.substring(1) : o3 : ""}`] = "true", (e3 = this.container) === null || e3 === void 0 || e3.appendChild(n3), n3;
    }
    build() {
      const t3 = this.instance.container, e3 = this.cn("container");
      let { container: i3, prev: n3, next: s3 } = this;
      i3 || (i3 = t3.querySelector("." + e3), this.isDom = !!i3), i3 || (i3 = document.createElement("div"), P(i3, e3), t3.appendChild(i3)), this.container = i3, s3 || (s3 = i3.querySelector("[data-carousel-next]")), s3 || (s3 = this.addBtn(X)), this.next = s3, n3 || (n3 = i3.querySelector("[data-carousel-prev]")), n3 || (n3 = this.addBtn(q)), this.prev = n3;
    }
    cleanup() {
      this.isDom || (this.prev && this.prev.remove(), this.next && this.next.remove(), this.container && this.container.remove()), this.prev = null, this.next = null, this.container = null, this.isDom = false;
    }
    attach() {
      this.instance.on(["refresh", "change"], this.onRefresh);
    }
    detach() {
      this.instance.off(["refresh", "change"], this.onRefresh), this.cleanup();
    }
  };
  Object.defineProperty(Y, "defaults", { enumerable: true, configurable: true, writable: true, value: { classes: { container: "f-carousel__nav", button: "f-button", isNext: "is-next", isPrev: "is-prev" }, nextTpl: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" tabindex="-1"><path d="M9 3l9 9-9 9"/></svg>', prevTpl: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" tabindex="-1"><path d="M15 3l-9 9 9 9"/></svg>' } });
  var V = class extends N {
    constructor() {
      super(...arguments), Object.defineProperty(this, "selectedIndex", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "target", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "nav", { enumerable: true, configurable: true, writable: true, value: null });
    }
    addAsTargetFor(t3) {
      this.target = this.instance, this.nav = t3, this.attachEvents();
    }
    addAsNavFor(t3) {
      this.nav = this.instance, this.target = t3, this.attachEvents();
    }
    attachEvents() {
      const { nav: t3, target: e3 } = this;
      t3 && e3 && (t3.options.initialSlide = e3.options.initialPage, t3.state === j.Ready ? this.onNavReady(t3) : t3.on("ready", this.onNavReady), e3.state === j.Ready ? this.onTargetReady(e3) : e3.on("ready", this.onTargetReady));
    }
    onNavReady(t3) {
      t3.on("createSlide", this.onNavCreateSlide), t3.on("Panzoom.click", this.onNavClick), t3.on("Panzoom.touchEnd", this.onNavTouch), this.onTargetChange();
    }
    onTargetReady(t3) {
      t3.on("change", this.onTargetChange), t3.on("Panzoom.refresh", this.onTargetChange), this.onTargetChange();
    }
    onNavClick(t3, e3, i3) {
      this.onNavTouch(t3, t3.panzoom, i3);
    }
    onNavTouch(t3, e3, i3) {
      var n3, s3;
      if (Math.abs(e3.dragOffset.x) > 3 || Math.abs(e3.dragOffset.y) > 3)
        return;
      const o3 = i3.target, { nav: a3, target: r3 } = this;
      if (!a3 || !r3 || !o3)
        return;
      const l3 = o3.closest("[data-index]");
      if (i3.stopPropagation(), i3.preventDefault(), !l3)
        return;
      const c3 = parseInt(l3.dataset.index || "", 10) || 0, h3 = r3.getPageForSlide(c3), d3 = a3.getPageForSlide(c3);
      a3.slideTo(d3), r3.slideTo(h3, { friction: ((s3 = (n3 = this.nav) === null || n3 === void 0 ? void 0 : n3.plugins) === null || s3 === void 0 ? void 0 : s3.Sync.option("friction")) || 0 }), this.markSelectedSlide(c3);
    }
    onNavCreateSlide(t3, e3) {
      e3.index === this.selectedIndex && this.markSelectedSlide(e3.index);
    }
    onTargetChange() {
      var t3, e3;
      const { target: i3, nav: n3 } = this;
      if (!i3 || !n3)
        return;
      if (n3.state !== j.Ready || i3.state !== j.Ready)
        return;
      const s3 = (e3 = (t3 = i3.pages[i3.page]) === null || t3 === void 0 ? void 0 : t3.slides[0]) === null || e3 === void 0 ? void 0 : e3.index, o3 = n3.getPageForSlide(s3);
      this.markSelectedSlide(s3), n3.slideTo(o3, n3.prevPage === null && i3.prevPage === null ? { friction: 0 } : void 0);
    }
    markSelectedSlide(t3) {
      const e3 = this.nav;
      e3 && e3.state === j.Ready && (this.selectedIndex = t3, [...e3.slides].map((e4) => {
        e4.el && e4.el.classList[e4.index === t3 ? "add" : "remove"]("is-nav-selected");
      }));
    }
    attach() {
      const t3 = this;
      let e3 = t3.options.target, i3 = t3.options.nav;
      e3 ? t3.addAsNavFor(e3) : i3 && t3.addAsTargetFor(i3);
    }
    detach() {
      const t3 = this, e3 = t3.nav, i3 = t3.target;
      e3 && (e3.off("ready", t3.onNavReady), e3.off("createSlide", t3.onNavCreateSlide), e3.off("Panzoom.click", t3.onNavClick), e3.off("Panzoom.touchEnd", t3.onNavTouch)), t3.nav = null, i3 && (i3.off("ready", t3.onTargetReady), i3.off("refresh", t3.onTargetChange), i3.off("change", t3.onTargetChange)), t3.target = null;
    }
  };
  Object.defineProperty(V, "defaults", { enumerable: true, configurable: true, writable: true, value: { friction: 0.35 } });
  var Z = { Navigation: Y, Dots: $, Sync: V };
  var U = "animationend";
  var G = "isSelected";
  var K = "slide";
  var J = class extends g {
    get axis() {
      return this.isHorizontal ? "e" : "f";
    }
    get isEnabled() {
      return this.state === j.Ready;
    }
    get isInfinite() {
      let t3 = false;
      const { contentDim: e3, viewportDim: i3, pages: n3, slides: s3 } = this, o3 = s3[0];
      return n3.length >= 2 && o3 && e3 + o3.dim >= i3 && (t3 = this.option("infinite")), t3;
    }
    get isRTL() {
      return this.option("direction") === "rtl";
    }
    get isHorizontal() {
      return this.option("axis") === "x";
    }
    constructor(t3, e3 = {}, i3 = {}) {
      if (super(), Object.defineProperty(this, "bp", { enumerable: true, configurable: true, writable: true, value: "" }), Object.defineProperty(this, "lp", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "userOptions", { enumerable: true, configurable: true, writable: true, value: {} }), Object.defineProperty(this, "userPlugins", { enumerable: true, configurable: true, writable: true, value: {} }), Object.defineProperty(this, "state", { enumerable: true, configurable: true, writable: true, value: j.Init }), Object.defineProperty(this, "page", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "prevPage", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "container", { enumerable: true, configurable: true, writable: true, value: void 0 }), Object.defineProperty(this, "viewport", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "track", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "slides", { enumerable: true, configurable: true, writable: true, value: [] }), Object.defineProperty(this, "pages", { enumerable: true, configurable: true, writable: true, value: [] }), Object.defineProperty(this, "panzoom", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "inTransition", { enumerable: true, configurable: true, writable: true, value: new Set() }), Object.defineProperty(this, "contentDim", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "viewportDim", { enumerable: true, configurable: true, writable: true, value: 0 }), typeof t3 == "string" && (t3 = document.querySelector(t3)), !t3 || !E(t3))
        throw new Error("No Element found");
      this.container = t3, this.slideNext = I(this.slideNext.bind(this), 150), this.slidePrev = I(this.slidePrev.bind(this), 150), this.userOptions = e3, this.userPlugins = i3, queueMicrotask(() => {
        this.processOptions();
      });
    }
    processOptions() {
      var t3, e3;
      const i3 = u({}, J.defaults, this.userOptions);
      let n3 = "";
      const s3 = i3.breakpoints;
      if (s3 && d(s3))
        for (const [t4, e4] of Object.entries(s3))
          window.matchMedia(t4).matches && d(e4) && (n3 += t4, u(i3, e4));
      n3 === this.bp && this.state !== j.Init || (this.bp = n3, this.state === j.Ready && (i3.initialSlide = ((e3 = (t3 = this.pages[this.page]) === null || t3 === void 0 ? void 0 : t3.slides[0]) === null || e3 === void 0 ? void 0 : e3.index) || 0), this.state !== j.Init && this.destroy(), super.setOptions(i3), this.option("enabled") === false ? this.attachEvents() : setTimeout(() => {
        this.init();
      }, 0));
    }
    init() {
      this.state = j.Init, this.emit("init"), this.attachPlugins(Object.assign(Object.assign({}, J.Plugins), this.userPlugins)), this.emit("attachPlugins"), this.initLayout(), this.initSlides(), this.updateMetrics(), this.setInitialPosition(), this.initPanzoom(), this.attachEvents(), this.state = j.Ready, this.emit("ready");
    }
    initLayout() {
      const { container: t3 } = this, e3 = this.option("classes");
      P(t3, this.cn("container")), o(t3, e3.isLTR, !this.isRTL), o(t3, e3.isRTL, this.isRTL), o(t3, e3.isVertical, !this.isHorizontal), o(t3, e3.isHorizontal, this.isHorizontal);
      let i3 = this.option("viewport") || t3.querySelector(`.${e3.viewport}`);
      i3 || (i3 = document.createElement("div"), P(i3, e3.viewport), i3.append(...D(t3, `.${e3.slide}`)), t3.prepend(i3)), i3.addEventListener("scroll", this.onScroll);
      let n3 = this.option("track") || t3.querySelector(`.${e3.track}`);
      n3 || (n3 = document.createElement("div"), P(n3, e3.track), n3.append(...Array.from(i3.childNodes))), n3.setAttribute("aria-live", "polite"), i3.contains(n3) || i3.prepend(n3), this.viewport = i3, this.track = n3, this.emit("initLayout");
    }
    initSlides() {
      const { track: t3 } = this;
      if (!t3)
        return;
      const e3 = [...this.slides], i3 = [];
      [...D(t3, `.${this.cn(K)}`)].forEach((t4) => {
        if (E(t4)) {
          const e4 = B({ el: t4, isDom: true, index: this.slides.length });
          i3.push(e4);
        }
      });
      for (let t4 of [...this.option("slides", []) || [], ...e3])
        i3.push(B(t4));
      this.slides = i3;
      for (let t4 = 0; t4 < this.slides.length; t4++)
        this.slides[t4].index = t4;
      for (const t4 of i3)
        this.emit("beforeInitSlide", t4, t4.index), this.emit("initSlide", t4, t4.index);
      this.emit("initSlides");
    }
    setInitialPage() {
      const t3 = this.option("initialSlide");
      this.page = typeof t3 == "number" ? this.getPageForSlide(t3) : parseInt(this.option("initialPage", 0) + "", 10) || 0;
    }
    setInitialPosition() {
      const { track: t3, pages: e3, isHorizontal: i3 } = this;
      if (!t3 || !e3.length)
        return;
      let n3 = this.page;
      e3[n3] || (this.page = n3 = 0);
      const s3 = (e3[n3].pos || 0) * (this.isRTL && i3 ? 1 : -1), o3 = i3 ? `${s3}px` : "0", a3 = i3 ? "0" : `${s3}px`;
      t3.style.transform = `translate3d(${o3}, ${a3}, 0) scale(1)`, this.option("adaptiveHeight") && this.setViewportHeight();
    }
    initPanzoom() {
      this.panzoom && (this.panzoom.destroy(), this.panzoom = null);
      const t3 = this.option("Panzoom") || {};
      this.panzoom = new k(this.viewport, u({}, { content: this.track, zoom: false, panOnlyZoomed: false, lockAxis: this.isHorizontal ? "x" : "y", infinite: this.isInfinite, click: false, dblClick: false, touch: (t4) => !(this.pages.length < 2 && !t4.options.infinite), bounds: () => this.getBounds(), maxVelocity: (t4) => Math.abs(t4.target[this.axis] - t4.current[this.axis]) < 2 * this.viewportDim ? 100 : 0 }, t3)), this.panzoom.on("*", (t4, e3, ...i3) => {
        this.emit(`Panzoom.${e3}`, t4, ...i3);
      }), this.panzoom.on("decel", this.onDecel), this.panzoom.on("refresh", this.onRefresh), this.panzoom.on("beforeTransform", this.onBeforeTransform), this.panzoom.on("endAnimation", this.onEndAnimation);
    }
    attachEvents() {
      const t3 = this.container;
      t3 && (t3.addEventListener("click", this.onClick, { passive: false, capture: false }), t3.addEventListener("slideTo", this.onSlideTo)), window.addEventListener("resize", this.onResize);
    }
    createPages() {
      let t3 = [];
      const { contentDim: e3, viewportDim: i3 } = this;
      let n3 = this.option("slidesPerPage");
      n3 = (n3 === "auto" || e3 <= i3) && this.option("fill") !== false ? 1 / 0 : parseFloat(n3 + "");
      let s3 = 0, o3 = 0, a3 = 0;
      for (const e4 of this.slides)
        (!t3.length || o3 + e4.dim - i3 > 0.05 || a3 >= n3) && (t3.push(H()), s3 = t3.length - 1, o3 = 0, a3 = 0), t3[s3].slides.push(e4), o3 += e4.dim + e4.gap, a3++;
      return t3;
    }
    processPages() {
      const e3 = this.pages, { contentDim: i3, viewportDim: n3, isInfinite: s3 } = this, o3 = this.option("center"), a3 = this.option("fill"), r3 = a3 && o3 && i3 > n3 && !s3;
      if (e3.forEach((t3, e4) => {
        var s4;
        t3.index = e4, t3.pos = ((s4 = t3.slides[0]) === null || s4 === void 0 ? void 0 : s4.pos) || 0, t3.dim = 0;
        for (const [e5, i4] of t3.slides.entries())
          t3.dim += i4.dim, e5 < t3.slides.length - 1 && (t3.dim += i4.gap);
        r3 && t3.pos + 0.5 * t3.dim < 0.5 * n3 ? t3.pos = 0 : r3 && t3.pos + 0.5 * t3.dim >= i3 - 0.5 * n3 ? t3.pos = i3 - n3 : o3 && (t3.pos += -0.5 * (n3 - t3.dim));
      }), e3.forEach((e4) => {
        a3 && !s3 && i3 > n3 && (e4.pos = Math.max(e4.pos, 0), e4.pos = Math.min(e4.pos, i3 - n3)), e4.pos = t(e4.pos, 1e3), e4.dim = t(e4.dim, 1e3), Math.abs(e4.pos) <= 0.1 && (e4.pos = 0);
      }), s3)
        return e3;
      const l3 = [];
      let c3;
      return e3.forEach((t3) => {
        const e4 = Object.assign({}, t3);
        c3 && e4.pos === c3.pos ? (c3.dim += e4.dim, c3.slides = [...c3.slides, ...e4.slides]) : (e4.index = l3.length, c3 = e4, l3.push(e4));
      }), l3;
    }
    getPageFromIndex(t3 = 0) {
      const e3 = this.pages.length;
      let i3;
      return t3 = parseInt((t3 || 0).toString()) || 0, i3 = this.isInfinite ? (t3 % e3 + e3) % e3 : Math.max(Math.min(t3, e3 - 1), 0), i3;
    }
    getSlideMetrics(e3) {
      var i3, n3;
      const s3 = this.isHorizontal ? "width" : "height";
      let o3 = 0, a3 = 0, r3 = e3.el;
      const l3 = !(!r3 || r3.parentNode);
      if (r3 ? o3 = parseFloat(r3.dataset[s3] || "") || 0 : (r3 = document.createElement("div"), r3.style.visibility = "hidden", (this.track || document.body).prepend(r3)), P(r3, this.cn(K) + " " + e3.class + " " + e3.customClass), o3)
        r3.style[s3] = `${o3}px`, r3.style[s3 === "width" ? "height" : "width"] = "";
      else {
        l3 && (this.track || document.body).prepend(r3), o3 = r3.getBoundingClientRect()[s3] * Math.max(1, ((i3 = window.visualViewport) === null || i3 === void 0 ? void 0 : i3.scale) || 1);
        let t3 = r3[this.isHorizontal ? "offsetWidth" : "offsetHeight"];
        t3 - 1 > o3 && (o3 = t3);
      }
      const c3 = getComputedStyle(r3);
      return c3.boxSizing === "content-box" && (this.isHorizontal ? (o3 += parseFloat(c3.paddingLeft) || 0, o3 += parseFloat(c3.paddingRight) || 0) : (o3 += parseFloat(c3.paddingTop) || 0, o3 += parseFloat(c3.paddingBottom) || 0)), a3 = parseFloat(c3[this.isHorizontal ? "marginRight" : "marginBottom"]) || 0, l3 ? (n3 = r3.parentElement) === null || n3 === void 0 || n3.removeChild(r3) : e3.el || r3.remove(), { dim: t(o3, 1e3), gap: t(a3, 1e3) };
    }
    getBounds() {
      const { isInfinite: t3, isRTL: e3, isHorizontal: i3, pages: n3 } = this;
      let s3 = { min: 0, max: 0 };
      if (t3)
        s3 = { min: -1 / 0, max: 1 / 0 };
      else if (n3.length) {
        const t4 = n3[0].pos, o3 = n3[n3.length - 1].pos;
        s3 = e3 && i3 ? { min: t4, max: o3 } : { min: -1 * o3, max: -1 * t4 };
      }
      return { x: i3 ? s3 : { min: 0, max: 0 }, y: i3 ? { min: 0, max: 0 } : s3 };
    }
    repositionSlides() {
      let e3, { isHorizontal: i3, isRTL: n3, isInfinite: s3, viewport: o3, viewportDim: a3, contentDim: r3, page: l3, pages: c3, slides: h3, panzoom: d3 } = this, u3 = 0, p3 = 0, f3 = 0, g3 = 0;
      d3 ? g3 = -1 * d3.current[this.axis] : c3[l3] && (g3 = c3[l3].pos || 0), e3 = i3 ? n3 ? "right" : "left" : "top", n3 && i3 && (g3 *= -1);
      for (const i4 of h3) {
        const n4 = i4.el;
        n4 ? (e3 === "top" ? (n4.style.right = "", n4.style.left = "") : n4.style.top = "", i4.index !== u3 ? n4.style[e3] = p3 === 0 ? "" : `${t(p3, 1e3)}px` : n4.style[e3] = "", f3 += i4.dim + i4.gap, u3++) : p3 += i4.dim + i4.gap;
      }
      if (s3 && f3 && o3) {
        let n4 = getComputedStyle(o3), s4 = "padding", l4 = i3 ? "Right" : "Bottom", c4 = parseFloat(n4[s4 + (i3 ? "Left" : "Top")]);
        g3 -= c4, a3 += c4, a3 += parseFloat(n4[s4 + l4]);
        for (const i4 of h3)
          i4.el && (t(i4.pos) < t(a3) && t(i4.pos + i4.dim + i4.gap) < t(g3) && t(g3) > t(r3 - a3) && (i4.el.style[e3] = `${t(p3 + f3, 1e3)}px`), t(i4.pos + i4.gap) >= t(r3 - a3) && t(i4.pos) > t(g3 + a3) && t(g3) < t(a3) && (i4.el.style[e3] = `-${t(f3, 1e3)}px`));
      }
      let m2, v2, b3 = [...this.inTransition];
      if (b3.length > 1 && (m2 = c3[b3[0]], v2 = c3[b3[1]]), m2 && v2) {
        let i4 = 0;
        for (const n4 of h3)
          n4.el ? this.inTransition.has(n4.index) && m2.slides.indexOf(n4) < 0 && (n4.el.style[e3] = `${t(i4 + (m2.pos - v2.pos), 1e3)}px`) : i4 += n4.dim + n4.gap;
      }
    }
    createSlideEl(t3) {
      const { track: e3, slides: i3 } = this;
      if (!e3 || !t3)
        return;
      if (t3.el && t3.el.parentNode)
        return;
      const n3 = t3.el || document.createElement("div");
      P(n3, this.cn(K)), P(n3, t3.class), P(n3, t3.customClass);
      const s3 = t3.html;
      s3 && (s3 instanceof HTMLElement ? n3.appendChild(s3) : n3.innerHTML = t3.html + "");
      const o3 = [];
      i3.forEach((t4, e4) => {
        t4.el && o3.push(e4);
      });
      const a3 = t3.index;
      let r3 = null;
      if (o3.length) {
        r3 = i3[o3.reduce((t4, e4) => Math.abs(e4 - a3) < Math.abs(t4 - a3) ? e4 : t4)];
      }
      const l3 = r3 && r3.el && r3.el.parentNode ? r3.index < t3.index ? r3.el.nextSibling : r3.el : null;
      e3.insertBefore(n3, e3.contains(l3) ? l3 : null), t3.el = n3, this.emit("createSlide", t3);
    }
    removeSlideEl(t3, e3 = false) {
      const i3 = t3 == null ? void 0 : t3.el;
      if (!i3 || !i3.parentNode)
        return;
      const n3 = this.cn(G);
      if (i3.classList.contains(n3) && (S(i3, n3), this.emit("unselectSlide", t3)), t3.isDom && !e3)
        return i3.removeAttribute("aria-hidden"), i3.removeAttribute("data-index"), void (i3.style.left = "");
      this.emit("removeSlide", t3);
      const s3 = new CustomEvent(U);
      i3.dispatchEvent(s3), t3.el && (t3.el.remove(), t3.el = null);
    }
    transitionTo(t3 = 0, e3 = this.option("transition")) {
      var i3, n3, s3, o3;
      if (!e3)
        return false;
      const a3 = this.page, { pages: r3, panzoom: l3 } = this;
      t3 = parseInt((t3 || 0).toString()) || 0;
      const c3 = this.getPageFromIndex(t3);
      if (!l3 || !r3[c3] || r3.length < 2 || Math.abs((((n3 = (i3 = r3[a3]) === null || i3 === void 0 ? void 0 : i3.slides[0]) === null || n3 === void 0 ? void 0 : n3.dim) || 0) - this.viewportDim) > 1)
        return false;
      const h3 = t3 > a3 ? 1 : -1, d3 = r3[c3].pos * (this.isRTL ? 1 : -1);
      if (a3 === c3 && Math.abs(d3 - l3.target[this.axis]) < 1)
        return false;
      this.clearTransitions();
      const u3 = l3.isResting;
      P(this.container, this.cn("inTransition"));
      const p3 = ((s3 = r3[a3]) === null || s3 === void 0 ? void 0 : s3.slides[0]) || null, f3 = ((o3 = r3[c3]) === null || o3 === void 0 ? void 0 : o3.slides[0]) || null;
      this.inTransition.add(f3.index), this.createSlideEl(f3);
      let g3 = p3.el, m2 = f3.el;
      u3 || e3 === K || (e3 = "fadeFast", g3 = null);
      const v2 = this.isRTL ? "next" : "prev", b3 = this.isRTL ? "prev" : "next";
      return g3 && (this.inTransition.add(p3.index), p3.transition = e3, g3.addEventListener(U, this.onAnimationEnd), g3.classList.add(`f-${e3}Out`, `to-${h3 > 0 ? b3 : v2}`)), m2 && (f3.transition = e3, m2.addEventListener(U, this.onAnimationEnd), m2.classList.add(`f-${e3}In`, `from-${h3 > 0 ? v2 : b3}`)), l3.current[this.axis] = d3, l3.target[this.axis] = d3, l3.requestTick(), this.onChange(c3), true;
    }
    manageSlideVisiblity() {
      const t3 = new Set(), e3 = new Set(), i3 = this.getVisibleSlides(parseFloat(this.option("preload", 0) + "") || 0);
      for (const n3 of this.slides)
        i3.has(n3) ? t3.add(n3) : e3.add(n3);
      for (const e4 of this.inTransition)
        t3.add(this.slides[e4]);
      for (const e4 of t3)
        this.createSlideEl(e4), this.lazyLoadSlide(e4);
      for (const i4 of e3)
        t3.has(i4) || this.removeSlideEl(i4);
      this.markSelectedSlides(), this.repositionSlides();
    }
    markSelectedSlides() {
      if (!this.pages[this.page] || !this.pages[this.page].slides)
        return;
      const t3 = "aria-hidden";
      let e3 = this.cn(G);
      if (e3)
        for (const i3 of this.slides) {
          const n3 = i3.el;
          n3 && (n3.dataset.index = `${i3.index}`, n3.classList.contains("f-thumbs__slide") ? this.getVisibleSlides(0).has(i3) ? n3.removeAttribute(t3) : n3.setAttribute(t3, "true") : this.pages[this.page].slides.includes(i3) ? (n3.classList.contains(e3) || (P(n3, e3), this.emit("selectSlide", i3)), n3.removeAttribute(t3)) : (n3.classList.contains(e3) && (S(n3, e3), this.emit("unselectSlide", i3)), n3.setAttribute(t3, "true")));
        }
    }
    flipInfiniteTrack() {
      const { axis: t3, isHorizontal: e3, isInfinite: i3, isRTL: n3, viewportDim: s3, contentDim: o3 } = this, a3 = this.panzoom;
      if (!a3 || !i3)
        return;
      let r3 = a3.current[t3], l3 = a3.target[t3] - r3, c3 = 0, h3 = 0.5 * s3;
      n3 && e3 ? (r3 < -h3 && (c3 = -1, r3 += o3), r3 > o3 - h3 && (c3 = 1, r3 -= o3)) : (r3 > h3 && (c3 = 1, r3 -= o3), r3 < -o3 + h3 && (c3 = -1, r3 += o3)), c3 && (a3.current[t3] = r3, a3.target[t3] = r3 + l3);
    }
    lazyLoadImg(t3, e3) {
      const i3 = this, s3 = "f-fadeIn", o3 = "is-preloading";
      let a3 = false, r3 = null;
      const l3 = () => {
        a3 || (a3 = true, r3 && (r3.remove(), r3 = null), S(e3, o3), e3.complete && (P(e3, s3), setTimeout(() => {
          S(e3, s3);
        }, 350)), this.option("adaptiveHeight") && t3.el && this.pages[this.page].slides.indexOf(t3) > -1 && (i3.updateMetrics(), i3.setViewportHeight()), this.emit("load", t3));
      };
      P(e3, o3), e3.src = e3.dataset.lazySrcset || e3.dataset.lazySrc || "", delete e3.dataset.lazySrc, delete e3.dataset.lazySrcset, e3.addEventListener("error", () => {
        l3();
      }), e3.addEventListener("load", () => {
        l3();
      }), setTimeout(() => {
        const i4 = e3.parentNode;
        i4 && t3.el && (e3.complete ? l3() : a3 || (r3 = n(x), i4.insertBefore(r3, e3)));
      }, 300);
    }
    lazyLoadSlide(t3) {
      const e3 = t3 && t3.el;
      if (!e3)
        return;
      const i3 = new Set();
      let n3 = Array.from(e3.querySelectorAll("[data-lazy-src],[data-lazy-srcset]"));
      e3.dataset.lazySrc && n3.push(e3), n3.map((t4) => {
        t4 instanceof HTMLImageElement ? i3.add(t4) : t4 instanceof HTMLElement && t4.dataset.lazySrc && (t4.style.backgroundImage = `url('${t4.dataset.lazySrc}')`, delete t4.dataset.lazySrc);
      });
      for (const e4 of i3)
        this.lazyLoadImg(t3, e4);
    }
    onAnimationEnd(t3) {
      var e3;
      const i3 = t3.target, n3 = i3 ? parseInt(i3.dataset.index || "", 10) || 0 : -1, s3 = this.slides[n3], o3 = t3.animationName;
      if (!i3 || !s3 || !o3)
        return;
      const a3 = !!this.inTransition.has(n3) && s3.transition;
      a3 && o3.substring(0, a3.length + 2) === `f-${a3}` && this.inTransition.delete(n3), this.inTransition.size || this.clearTransitions(), n3 === this.page && ((e3 = this.panzoom) === null || e3 === void 0 ? void 0 : e3.isResting) && this.emit("settle");
    }
    onDecel(t3, e3 = 0, i3 = 0, n3 = 0, s3 = 0) {
      if (this.option("dragFree"))
        return void this.setPageFromPosition();
      const { isRTL: o3, isHorizontal: a3, axis: r3, pages: l3 } = this, c3 = l3.length, h3 = Math.abs(Math.atan2(i3, e3) / (Math.PI / 180));
      let d3 = 0;
      if (d3 = h3 > 45 && h3 < 135 ? a3 ? 0 : i3 : a3 ? e3 : 0, !c3)
        return;
      let u3 = this.page, p3 = o3 && a3 ? 1 : -1;
      const f3 = t3.current[r3] * p3;
      let { pageIndex: g3 } = this.getPageFromPosition(f3);
      Math.abs(d3) > 5 ? (l3[u3].dim < document.documentElement["client" + (this.isHorizontal ? "Width" : "Height")] - 1 && (u3 = g3), u3 = o3 && a3 ? d3 < 0 ? u3 - 1 : u3 + 1 : d3 < 0 ? u3 + 1 : u3 - 1) : u3 = n3 === 0 && s3 === 0 ? u3 : g3, this.slideTo(u3, { transition: false, friction: t3.option("decelFriction") });
    }
    onClick(t3) {
      const e3 = t3.target, i3 = e3 && E(e3) ? e3.dataset : null;
      let n3, s3;
      i3 && (i3.carouselPage !== void 0 ? (s3 = "slideTo", n3 = i3.carouselPage) : i3.carouselNext !== void 0 ? s3 = "slideNext" : i3.carouselPrev !== void 0 && (s3 = "slidePrev")), s3 ? (t3.preventDefault(), t3.stopPropagation(), e3 && !e3.hasAttribute("disabled") && this[s3](n3)) : this.emit("click", t3);
    }
    onSlideTo(t3) {
      const e3 = t3.detail || 0;
      this.slideTo(this.getPageForSlide(e3), { friction: 0 });
    }
    onChange(t3, e3 = 0) {
      const i3 = this.page;
      this.prevPage = i3, this.page = t3, this.option("adaptiveHeight") && this.setViewportHeight(), t3 !== i3 && (this.markSelectedSlides(), this.emit("change", t3, i3, e3));
    }
    onRefresh() {
      let t3 = this.contentDim, e3 = this.viewportDim;
      this.updateMetrics(), this.contentDim === t3 && this.viewportDim === e3 || this.slideTo(this.page, { friction: 0, transition: false });
    }
    onScroll() {
      var t3;
      (t3 = this.viewport) === null || t3 === void 0 || t3.scroll(0, 0);
    }
    onResize() {
      this.option("breakpoints") && this.processOptions();
    }
    onBeforeTransform(t3) {
      this.lp !== t3.current[this.axis] && (this.flipInfiniteTrack(), this.manageSlideVisiblity()), this.lp = t3.current.e;
    }
    onEndAnimation() {
      this.inTransition.size || this.emit("settle");
    }
    reInit(t3 = null, e3 = null) {
      this.destroy(), this.state = j.Init, this.prevPage = null, this.userOptions = t3 || this.userOptions, this.userPlugins = e3 || this.userPlugins, this.processOptions();
    }
    slideTo(t3 = 0, { friction: e3 = this.option("friction"), transition: i3 = this.option("transition") } = {}) {
      if (this.state === j.Destroy)
        return;
      t3 = parseInt((t3 || 0).toString()) || 0;
      const n3 = this.getPageFromIndex(t3), { axis: s3, isHorizontal: o3, isRTL: a3, pages: r3, panzoom: l3 } = this, c3 = r3.length, h3 = a3 && o3 ? 1 : -1;
      if (!l3 || !c3)
        return;
      if (this.page !== n3) {
        const e4 = new Event("beforeChange", { bubbles: true, cancelable: true });
        if (this.emit("beforeChange", e4, t3), e4.defaultPrevented)
          return;
      }
      if (this.transitionTo(t3, i3))
        return;
      let d3 = r3[n3].pos;
      if (this.isInfinite) {
        const e4 = this.contentDim, i4 = l3.target[s3] * h3;
        if (c3 === 2)
          d3 += e4 * Math.floor(parseFloat(t3 + "") / 2);
        else {
          d3 = [d3, d3 - e4, d3 + e4].reduce(function(t4, e5) {
            return Math.abs(e5 - i4) < Math.abs(t4 - i4) ? e5 : t4;
          });
        }
      }
      d3 *= h3, Math.abs(l3.target[s3] - d3) < 1 || (l3.panTo({ x: o3 ? d3 : 0, y: o3 ? 0 : d3, friction: e3 }), this.onChange(n3));
    }
    slideToClosest(t3) {
      if (this.panzoom) {
        const { pageIndex: e3 } = this.getPageFromPosition();
        this.slideTo(e3, t3);
      }
    }
    slideNext() {
      this.slideTo(this.page + 1);
    }
    slidePrev() {
      this.slideTo(this.page - 1);
    }
    clearTransitions() {
      this.inTransition.clear(), S(this.container, this.cn("inTransition"));
      const t3 = ["to-prev", "to-next", "from-prev", "from-next"];
      for (const e3 of this.slides) {
        const i3 = e3.el;
        if (i3) {
          i3.removeEventListener(U, this.onAnimationEnd), i3.classList.remove(...t3);
          const n3 = e3.transition;
          n3 && i3.classList.remove(`f-${n3}Out`, `f-${n3}In`);
        }
      }
      this.manageSlideVisiblity();
    }
    addSlide(t3, e3) {
      var i3, n3, s3, o3;
      const a3 = this.panzoom, r3 = ((i3 = this.pages[this.page]) === null || i3 === void 0 ? void 0 : i3.pos) || 0, l3 = ((n3 = this.pages[this.page]) === null || n3 === void 0 ? void 0 : n3.dim) || 0, c3 = this.contentDim < this.viewportDim;
      let h3 = Array.isArray(e3) ? e3 : [e3];
      const d3 = [];
      for (const t4 of h3)
        d3.push(B(t4));
      this.slides.splice(t3, 0, ...d3);
      for (let t4 = 0; t4 < this.slides.length; t4++)
        this.slides[t4].index = t4;
      for (const t4 of d3)
        this.emit("beforeInitSlide", t4, t4.index);
      if (this.page >= t3 && (this.page += d3.length), this.updateMetrics(), a3) {
        const e4 = ((s3 = this.pages[this.page]) === null || s3 === void 0 ? void 0 : s3.pos) || 0, i4 = ((o3 = this.pages[this.page]) === null || o3 === void 0 ? void 0 : o3.dim) || 0, n4 = this.pages.length || 1, h4 = this.isRTL ? l3 - i4 : i4 - l3, d4 = this.isRTL ? r3 - e4 : e4 - r3;
        c3 && n4 === 1 ? (t3 <= this.page && (a3.current[this.axis] -= h4, a3.target[this.axis] -= h4), a3.panTo({ [this.isHorizontal ? "x" : "y"]: -1 * e4 })) : d4 && t3 <= this.page && (a3.target[this.axis] -= d4, a3.current[this.axis] -= d4, a3.requestTick());
      }
      for (const t4 of d3)
        this.emit("initSlide", t4, t4.index);
    }
    prependSlide(t3) {
      this.addSlide(0, t3);
    }
    appendSlide(t3) {
      this.addSlide(this.slides.length, t3);
    }
    removeSlide(t3) {
      const e3 = this.slides.length;
      t3 = (t3 % e3 + e3) % e3;
      const i3 = this.slides[t3];
      if (i3) {
        this.removeSlideEl(i3, true), this.slides.splice(t3, 1);
        for (let t4 = 0; t4 < this.slides.length; t4++)
          this.slides[t4].index = t4;
        this.updateMetrics(), this.slideTo(this.page, { friction: 0, transition: false }), this.emit("destroySlide", i3);
      }
    }
    updateMetrics() {
      const { panzoom: e3, viewport: i3, track: n3, slides: s3, isHorizontal: o3, isInfinite: a3 } = this;
      if (!n3)
        return;
      const r3 = o3 ? "width" : "height", l3 = o3 ? "offsetWidth" : "offsetHeight";
      if (i3) {
        let e4 = Math.max(i3[l3], t(i3.getBoundingClientRect()[r3], 1e3)), n4 = getComputedStyle(i3), s4 = "padding", a4 = o3 ? "Right" : "Bottom";
        e4 -= parseFloat(n4[s4 + (o3 ? "Left" : "Top")]) + parseFloat(n4[s4 + a4]), this.viewportDim = e4;
      }
      let c3, h3 = 0;
      for (const [e4, i4] of s3.entries()) {
        let n4 = 0, o4 = 0;
        !i4.el && c3 ? (n4 = c3.dim, o4 = c3.gap) : ({ dim: n4, gap: o4 } = this.getSlideMetrics(i4), c3 = i4), n4 = t(n4, 1e3), o4 = t(o4, 1e3), i4.dim = n4, i4.gap = o4, i4.pos = h3, h3 += n4, (a3 || e4 < s3.length - 1) && (h3 += o4);
      }
      h3 = t(h3, 1e3), this.contentDim = h3, e3 && (e3.contentRect[r3] = h3, e3.contentRect[o3 ? "fullWidth" : "fullHeight"] = h3), this.pages = this.createPages(), this.pages = this.processPages(), this.state === j.Init && this.setInitialPage(), this.page = Math.max(0, Math.min(this.page, this.pages.length - 1)), this.manageSlideVisiblity(), this.emit("refresh");
    }
    getProgress(e3, i3 = false, n3 = false) {
      e3 === void 0 && (e3 = this.page);
      const s3 = this, o3 = s3.panzoom, a3 = s3.contentDim, r3 = s3.pages[e3] || 0;
      if (!r3 || !o3)
        return e3 > this.page ? -1 : 1;
      let l3 = -1 * o3.current.e, c3 = t((l3 - r3.pos) / (1 * r3.dim), 1e3), h3 = c3, d3 = c3;
      this.isInfinite && n3 !== true && (h3 = t((l3 - r3.pos + a3) / (1 * r3.dim), 1e3), d3 = t((l3 - r3.pos - a3) / (1 * r3.dim), 1e3));
      let u3 = [c3, h3, d3].reduce(function(t3, e4) {
        return Math.abs(e4) < Math.abs(t3) ? e4 : t3;
      });
      return i3 ? u3 : u3 > 1 ? 1 : u3 < -1 ? -1 : u3;
    }
    setViewportHeight() {
      const { page: t3, pages: e3, viewport: i3, isHorizontal: n3 } = this;
      if (!i3 || !e3[t3])
        return;
      let s3 = 0;
      n3 && this.track && (this.track.style.height = "auto", e3[t3].slides.forEach((t4) => {
        t4.el && (s3 = Math.max(s3, t4.el.offsetHeight));
      })), i3.style.height = s3 ? `${s3}px` : "";
    }
    getPageForSlide(t3) {
      for (const e3 of this.pages)
        for (const i3 of e3.slides)
          if (i3.index === t3)
            return e3.index;
      return -1;
    }
    getVisibleSlides(t3 = 0) {
      var e3;
      const i3 = new Set();
      let { panzoom: n3, contentDim: s3, viewportDim: o3, pages: a3, page: r3 } = this;
      if (o3) {
        s3 = s3 + ((e3 = this.slides[this.slides.length - 1]) === null || e3 === void 0 ? void 0 : e3.gap) || 0;
        let l3 = 0;
        l3 = n3 && n3.state !== m.Init && n3.state !== m.Destroy ? -1 * n3.current[this.axis] : a3[r3] && a3[r3].pos || 0, this.isInfinite && (l3 -= Math.floor(l3 / s3) * s3), this.isRTL && this.isHorizontal && (l3 *= -1);
        const c3 = l3 - o3 * t3, h3 = l3 + o3 * (t3 + 1), d3 = this.isInfinite ? [-1, 0, 1] : [0];
        for (const t4 of this.slides)
          for (const e4 of d3) {
            const n4 = t4.pos + e4 * s3, o4 = n4 + t4.dim + t4.gap;
            n4 < h3 && o4 > c3 && i3.add(t4);
          }
      }
      return i3;
    }
    getPageFromPosition(t3) {
      const { viewportDim: e3, contentDim: i3, slides: n3, pages: s3, panzoom: o3 } = this, a3 = s3.length, r3 = n3.length, l3 = n3[0], c3 = n3[r3 - 1], h3 = this.option("center");
      let d3 = 0, u3 = 0, p3 = 0, f3 = t3 === void 0 ? -1 * ((o3 == null ? void 0 : o3.target[this.axis]) || 0) : t3;
      h3 && (f3 += 0.5 * e3), this.isInfinite ? (f3 < l3.pos - 0.5 * c3.gap && (f3 -= i3, p3 = -1), f3 > c3.pos + c3.dim + 0.5 * c3.gap && (f3 -= i3, p3 = 1)) : f3 = Math.max(l3.pos || 0, Math.min(f3, c3.pos));
      let g3 = c3, m2 = n3.find((t4) => {
        const e4 = t4.pos - 0.5 * g3.gap, i4 = t4.pos + t4.dim + 0.5 * t4.gap;
        return g3 = t4, f3 >= e4 && f3 < i4;
      });
      return m2 || (m2 = c3), u3 = this.getPageForSlide(m2.index), d3 = u3 + p3 * a3, { page: d3, pageIndex: u3 };
    }
    setPageFromPosition() {
      const { pageIndex: t3 } = this.getPageFromPosition();
      this.onChange(t3);
    }
    destroy() {
      if ([j.Destroy].includes(this.state))
        return;
      this.state = j.Destroy;
      const { container: t3, viewport: e3, track: i3, slides: n3, panzoom: s3 } = this, o3 = this.option("classes");
      t3.removeEventListener("click", this.onClick, { passive: false, capture: false }), t3.removeEventListener("slideTo", this.onSlideTo), window.removeEventListener("resize", this.onResize), s3 && (s3.destroy(), this.panzoom = null), n3 && n3.forEach((t4) => {
        this.removeSlideEl(t4);
      }), this.detachPlugins(), e3 && (e3.removeEventListener("scroll", this.onScroll), e3.offsetParent && i3 && i3.offsetParent && e3.replaceWith(...i3.childNodes));
      for (const [e4, i4] of Object.entries(o3))
        e4 !== "container" && i4 && t3.classList.remove(i4);
      this.track = null, this.viewport = null, this.page = 0, this.slides = [];
      const a3 = this.events.get("ready");
      this.events = new Map(), a3 && this.events.set("ready", a3);
    }
  };
  Object.defineProperty(J, "Panzoom", { enumerable: true, configurable: true, writable: true, value: k }), Object.defineProperty(J, "defaults", { enumerable: true, configurable: true, writable: true, value: F }), Object.defineProperty(J, "Plugins", { enumerable: true, configurable: true, writable: true, value: Z });
  var Q = function(t3) {
    if (!E(t3))
      return 0;
    const e3 = window.scrollY, i3 = window.innerHeight, n3 = e3 + i3, s3 = t3.getBoundingClientRect(), o3 = s3.y + e3, a3 = s3.height, r3 = o3 + a3;
    if (e3 > r3 || n3 < o3)
      return 0;
    if (e3 < o3 && n3 > r3)
      return 100;
    if (o3 < e3 && r3 > n3)
      return 100;
    let l3 = a3;
    o3 < e3 && (l3 -= e3 - o3), r3 > n3 && (l3 -= r3 - n3);
    const c3 = l3 / i3 * 100;
    return Math.round(c3);
  };
  var tt = !(typeof window == "undefined" || !window.document || !window.document.createElement);
  var et;
  var it = ["a[href]", "area[href]", 'input:not([disabled]):not([type="hidden"]):not([aria-hidden])', "select:not([disabled]):not([aria-hidden])", "textarea:not([disabled]):not([aria-hidden])", "button:not([disabled]):not([aria-hidden]):not(.fancybox-focus-guard)", "iframe", "object", "embed", "video", "audio", "[contenteditable]", '[tabindex]:not([tabindex^="-"]):not([disabled]):not([aria-hidden])'].join(",");
  var nt = (t3) => {
    if (t3 && tt) {
      et === void 0 && document.createElement("div").focus({ get preventScroll() {
        return et = true, false;
      } });
      try {
        if (et)
          t3.focus({ preventScroll: true });
        else {
          const e3 = window.scrollY || document.body.scrollTop, i3 = window.scrollX || document.body.scrollLeft;
          t3.focus(), document.body.scrollTo({ top: e3, left: i3, behavior: "auto" });
        }
      } catch (t4) {
      }
    }
  };
  var st = () => {
    const t3 = document;
    let e3, i3 = "", n3 = "", s3 = "";
    return t3.fullscreenEnabled ? (i3 = "requestFullscreen", n3 = "exitFullscreen", s3 = "fullscreenElement") : t3.webkitFullscreenEnabled && (i3 = "webkitRequestFullscreen", n3 = "webkitExitFullscreen", s3 = "webkitFullscreenElement"), i3 && (e3 = { request: function(e4 = t3.documentElement) {
      return i3 === "webkitRequestFullscreen" ? e4[i3](Element.ALLOW_KEYBOARD_INPUT) : e4[i3]();
    }, exit: function() {
      return t3[s3] && t3[n3]();
    }, isFullscreen: function() {
      return t3[s3];
    } }), e3;
  };
  var ot = { dragToClose: true, hideScrollbar: true, Carousel: { classes: { container: "fancybox__carousel", viewport: "fancybox__viewport", track: "fancybox__track", slide: "fancybox__slide" } }, contentClick: "toggleZoom", contentDblClick: false, backdropClick: "close", animated: true, idle: 3500, showClass: "f-zoomInUp", hideClass: "f-fadeOut", commonCaption: false, parentEl: null, startIndex: 0, l10n: Object.assign(Object.assign({}, b), { CLOSE: "Close", NEXT: "Next", PREV: "Previous", MODAL: "You can close this modal content with the ESC key", ERROR: "Something Went Wrong, Please Try Again Later", IMAGE_ERROR: "Image Not Found", ELEMENT_NOT_FOUND: "HTML Element Not Found", AJAX_NOT_FOUND: "Error Loading AJAX : Not Found", AJAX_FORBIDDEN: "Error Loading AJAX : Forbidden", IFRAME_ERROR: "Error Loading Page", TOGGLE_ZOOM: "Toggle zoom level", TOGGLE_THUMBS: "Toggle thumbnails", TOGGLE_SLIDESHOW: "Toggle slideshow", TOGGLE_FULLSCREEN: "Toggle full-screen mode", DOWNLOAD: "Download" }), tpl: { closeButton: '<button data-fancybox-close class="f-button is-close-btn" title="{{CLOSE}}"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" tabindex="-1"><path d="M20 20L4 4m16 0L4 20"/></svg></button>', main: '<div class="fancybox__container" role="dialog" aria-modal="true" aria-label="{{MODAL}}" tabindex="-1">\n    <div class="fancybox__backdrop"></div>\n    <div class="fancybox__carousel"></div>\n    <div class="fancybox__footer"></div>\n  </div>' }, groupAll: false, groupAttr: "data-fancybox", defaultType: "image", defaultDisplay: "block", autoFocus: true, trapFocus: true, placeFocusBack: true, closeButton: "auto", keyboard: { Escape: "close", Delete: "close", Backspace: "close", PageUp: "next", PageDown: "prev", ArrowUp: "prev", ArrowDown: "next", ArrowRight: "next", ArrowLeft: "prev" }, Fullscreen: { autoStart: false }, compact: () => window.matchMedia("(max-width: 578px), (max-height: 578px)").matches, wheel: "zoom" };
  var at;
  var rt;
  !function(t3) {
    t3[t3.Init = 0] = "Init", t3[t3.Ready = 1] = "Ready", t3[t3.Closing = 2] = "Closing", t3[t3.CustomClosing = 3] = "CustomClosing", t3[t3.Destroy = 4] = "Destroy";
  }(at || (at = {})), function(t3) {
    t3[t3.Loading = 0] = "Loading", t3[t3.Opening = 1] = "Opening", t3[t3.Ready = 2] = "Ready", t3[t3.Closing = 3] = "Closing";
  }(rt || (rt = {}));
  var lt = "";
  var ct = false;
  var ht = false;
  var dt = null;
  var ut = () => {
    let t3 = "", e3 = "";
    const i3 = Ce.getInstance();
    if (i3) {
      const n3 = i3.carousel, s3 = i3.getSlide();
      if (n3 && s3) {
        let o3 = s3.slug || void 0, a3 = s3.triggerEl || void 0;
        e3 = o3 || (i3.option("slug") || ""), !e3 && a3 && a3.dataset && (e3 = a3.dataset.fancybox || ""), e3 && e3 !== "true" && (t3 = "#" + e3 + (!o3 && n3.slides.length > 1 ? "-" + (s3.index + 1) : ""));
      }
    }
    return { hash: t3, slug: e3, index: 1 };
  };
  var pt = () => {
    const t3 = new URL(document.URL).hash, e3 = t3.slice(1).split("-"), i3 = e3[e3.length - 1], n3 = i3 && /^\+?\d+$/.test(i3) && parseInt(e3.pop() || "1", 10) || 1;
    return { hash: t3, slug: e3.join("-"), index: n3 };
  };
  var ft = () => {
    const { slug: t3, index: e3 } = pt();
    if (!t3)
      return;
    let i3 = document.querySelector(`[data-slug="${t3}"]`);
    if (i3 && i3.dispatchEvent(new CustomEvent("click", { bubbles: true, cancelable: true })), Ce.getInstance())
      return;
    const n3 = document.querySelectorAll(`[data-fancybox="${t3}"]`);
    n3.length && (i3 = n3[e3 - 1], i3 && i3.dispatchEvent(new CustomEvent("click", { bubbles: true, cancelable: true })));
  };
  var gt = () => {
    if (Ce.defaults.Hash === false)
      return;
    const t3 = Ce.getInstance();
    if ((t3 == null ? void 0 : t3.options.Hash) === false)
      return;
    const { slug: e3, index: i3 } = pt(), { slug: n3 } = ut();
    t3 && (e3 === n3 ? t3.jumpTo(i3 - 1) : (ct = true, t3.close())), ft();
  };
  var mt = () => {
    dt && clearTimeout(dt), queueMicrotask(() => {
      gt();
    });
  };
  var vt = () => {
    window.addEventListener("hashchange", mt, false), setTimeout(() => {
      gt();
    }, 500);
  };
  tt && (/complete|interactive|loaded/.test(document.readyState) ? vt() : document.addEventListener("DOMContentLoaded", vt));
  var bt = "is-zooming-in";
  var yt = class extends N {
    onCreateSlide(t3, e3, i3) {
      const n3 = this.instance.optionFor(i3, "src") || "";
      i3.el && i3.type === "image" && typeof n3 == "string" && this.setImage(i3, n3);
    }
    onRemoveSlide(t3, e3, i3) {
      i3.panzoom && i3.panzoom.destroy(), i3.panzoom = void 0, i3.imageEl = void 0;
    }
    onChange(t3, e3, i3, n3) {
      S(this.instance.container, bt);
      for (const t4 of e3.slides) {
        const e4 = t4.panzoom;
        e4 && t4.index !== i3 && e4.reset(0.35);
      }
    }
    onClose() {
      var t3;
      const e3 = this.instance, i3 = e3.container, n3 = e3.getSlide();
      if (!i3 || !i3.parentElement || !n3)
        return;
      const { el: s3, contentEl: o3, panzoom: a3, thumbElSrc: r3 } = n3;
      if (!s3 || !r3 || !o3 || !a3 || a3.isContentLoading || a3.state === m.Init || a3.state === m.Destroy)
        return;
      a3.updateMetrics();
      let l3 = this.getZoomInfo(n3);
      if (!l3)
        return;
      this.instance.state = at.CustomClosing, i3.classList.remove(bt), i3.classList.add("is-zooming-out"), o3.style.backgroundImage = `url('${r3}')`;
      const c3 = i3.getBoundingClientRect();
      (((t3 = window.visualViewport) === null || t3 === void 0 ? void 0 : t3.scale) || 1) === 1 && Object.assign(i3.style, { position: "absolute", top: `${i3.offsetTop + window.scrollY}px`, left: `${i3.offsetLeft + window.scrollX}px`, bottom: "auto", right: "auto", width: `${c3.width}px`, height: `${c3.height}px`, overflow: "hidden" });
      const { x: h3, y: d3, scale: u3, opacity: p3 } = l3;
      if (p3) {
        const t4 = ((t5, e4, i4, n4) => {
          const s4 = e4 - t5, o4 = n4 - i4;
          return (e5) => i4 + ((e5 - t5) / s4 * o4 || 0);
        })(a3.scale, u3, 1, 0);
        a3.on("afterTransform", () => {
          o3.style.opacity = t4(a3.scale) + "";
        });
      }
      a3.on("endAnimation", () => {
        e3.destroy();
      }), a3.target.a = u3, a3.target.b = 0, a3.target.c = 0, a3.target.d = u3, a3.panTo({ x: h3, y: d3, scale: u3, friction: p3 ? 0.2 : 0.33, ignoreBounds: true }), a3.isResting && e3.destroy();
    }
    setImage(t3, e3) {
      const i3 = this.instance;
      t3.src = e3, this.process(t3, e3).then((e4) => {
        const { contentEl: n3, imageEl: s3, thumbElSrc: o3, el: a3 } = t3;
        if (i3.isClosing() || !n3 || !s3)
          return;
        n3.offsetHeight;
        const r3 = !!i3.isOpeningSlide(t3) && this.getZoomInfo(t3);
        if (this.option("protected") && a3) {
          a3.addEventListener("contextmenu", (t5) => {
            t5.preventDefault();
          });
          const t4 = document.createElement("div");
          P(t4, "fancybox-protected"), n3.appendChild(t4);
        }
        if (o3 && r3) {
          const s4 = e4.contentRect, a4 = Math.max(s4.fullWidth, s4.fullHeight);
          let c3 = null;
          !r3.opacity && a4 > 1200 && (c3 = document.createElement("img"), P(c3, "fancybox-ghost"), c3.src = o3, n3.appendChild(c3));
          const h3 = () => {
            c3 && (P(c3, "f-fadeFastOut"), setTimeout(() => {
              c3 && (c3.remove(), c3 = null);
            }, 200));
          };
          (l3 = o3, new Promise((t4, e5) => {
            const i4 = new Image();
            i4.onload = t4, i4.onerror = e5, i4.src = l3;
          })).then(() => {
            i3.hideLoading(t3), t3.state = rt.Opening, this.instance.emit("reveal", t3), this.zoomIn(t3).then(() => {
              h3(), this.instance.done(t3);
            }, () => {
            }), c3 && setTimeout(() => {
              h3();
            }, a4 > 2500 ? 800 : 200);
          }, () => {
            i3.hideLoading(t3), i3.revealContent(t3);
          });
        } else {
          const n4 = this.optionFor(t3, "initialSize"), s4 = this.optionFor(t3, "zoom"), o4 = { event: i3.prevMouseMoveEvent || i3.options.event, friction: s4 ? 0.12 : 0 };
          let a4 = i3.optionFor(t3, "showClass") || void 0, r4 = true;
          i3.isOpeningSlide(t3) && (n4 === "full" ? e4.zoomToFull(o4) : n4 === "cover" ? e4.zoomToCover(o4) : n4 === "max" ? e4.zoomToMax(o4) : r4 = false, e4.stop("current")), r4 && a4 && (a4 = e4.isDragging ? "f-fadeIn" : ""), i3.hideLoading(t3), i3.revealContent(t3, a4);
        }
        var l3;
      }, () => {
        i3.setError(t3, "{{IMAGE_ERROR}}");
      });
    }
    process(t3, e3) {
      return new Promise((i3, s3) => {
        var o3;
        const a3 = this.instance, r3 = t3.el;
        a3.clearContent(t3), a3.showLoading(t3);
        let l3 = this.optionFor(t3, "content");
        if (typeof l3 == "string" && (l3 = n(l3)), !l3 || !E(l3)) {
          if (l3 = document.createElement("img"), l3 instanceof HTMLImageElement) {
            let i4 = "", n3 = t3.caption;
            i4 = typeof n3 == "string" && n3 ? n3.replace(/<[^>]+>/gi, "").substring(0, 1e3) : `Image ${t3.index + 1} of ${((o3 = a3.carousel) === null || o3 === void 0 ? void 0 : o3.pages.length) || 1}`, l3.src = e3 || "", l3.alt = i4, l3.draggable = false, t3.srcset && l3.setAttribute("srcset", t3.srcset), this.instance.isOpeningSlide(t3) && (l3.fetchPriority = "high");
          }
          t3.sizes && l3.setAttribute("sizes", t3.sizes);
        }
        P(l3, "fancybox-image"), t3.imageEl = l3, a3.setContent(t3, l3, false);
        t3.panzoom = new k(r3, u({ transformParent: true }, this.option("Panzoom") || {}, { content: l3, width: a3.optionFor(t3, "width", "auto"), height: a3.optionFor(t3, "height", "auto"), wheel: () => {
          const t4 = a3.option("wheel");
          return (t4 === "zoom" || t4 == "pan") && t4;
        }, click: (e4, i4) => {
          var n3, s4;
          if (a3.isCompact || a3.isClosing())
            return false;
          if (t3.index !== ((n3 = a3.getSlide()) === null || n3 === void 0 ? void 0 : n3.index))
            return false;
          if (i4) {
            const t4 = i4.composedPath()[0];
            if (["A", "BUTTON", "TEXTAREA", "OPTION", "INPUT", "SELECT", "VIDEO"].includes(t4.nodeName))
              return false;
          }
          let o4 = !i4 || i4.target && ((s4 = t3.contentEl) === null || s4 === void 0 ? void 0 : s4.contains(i4.target));
          return a3.option(o4 ? "contentClick" : "backdropClick") || false;
        }, dblClick: () => a3.isCompact ? "toggleZoom" : a3.option("contentDblClick") || false, spinner: false, panOnlyZoomed: true, wheelLimit: 1 / 0, on: { ready: (t4) => {
          i3(t4);
        }, error: () => {
          s3();
        }, destroy: () => {
          s3();
        } } }));
      });
    }
    zoomIn(t3) {
      return new Promise((e3, i3) => {
        const n3 = this.instance, s3 = n3.container, { panzoom: o3, contentEl: a3, el: r3 } = t3;
        o3 && o3.updateMetrics();
        const l3 = this.getZoomInfo(t3);
        if (!(l3 && r3 && a3 && o3 && s3))
          return void i3();
        const { x: c3, y: h3, scale: d3, opacity: u3 } = l3, p3 = () => {
          t3.state !== rt.Closing && (u3 && (a3.style.opacity = Math.max(Math.min(1, 1 - (1 - o3.scale) / (1 - d3)), 0) + ""), o3.scale >= 1 && o3.scale > o3.targetScale - 0.1 && e3(o3));
        }, f3 = (t4) => {
          (t4.scale < 0.99 || t4.scale > 1.01) && !t4.isDragging || (S(s3, bt), a3.style.opacity = "", t4.off("endAnimation", f3), t4.off("touchStart", f3), t4.off("afterTransform", p3), e3(t4));
        };
        o3.on("endAnimation", f3), o3.on("touchStart", f3), o3.on("afterTransform", p3), o3.on(["error", "destroy"], () => {
          i3();
        }), o3.panTo({ x: c3, y: h3, scale: d3, friction: 0, ignoreBounds: true }), o3.stop("current");
        const g3 = { event: o3.panMode === "mousemove" ? n3.prevMouseMoveEvent || n3.options.event : void 0 }, m2 = this.optionFor(t3, "initialSize");
        P(s3, bt), n3.hideLoading(t3), m2 === "full" ? o3.zoomToFull(g3) : m2 === "cover" ? o3.zoomToCover(g3) : m2 === "max" ? o3.zoomToMax(g3) : o3.reset(0.172);
      });
    }
    getZoomInfo(t3) {
      const { el: e3, imageEl: i3, thumbEl: n3, panzoom: s3 } = t3, o3 = this.instance, a3 = o3.container;
      if (!e3 || !i3 || !n3 || !s3 || Q(n3) < 3 || !this.optionFor(t3, "zoom") || !a3 || o3.state === at.Destroy)
        return false;
      if (getComputedStyle(a3).getPropertyValue("--f-images-zoom") === "0")
        return false;
      const r3 = window.visualViewport || null;
      if ((r3 ? r3.scale : 1) !== 1)
        return false;
      let { top: l3, left: c3, width: h3, height: d3 } = n3.getBoundingClientRect(), { top: u3, left: p3, fitWidth: f3, fitHeight: g3 } = s3.contentRect;
      if (!(h3 && d3 && f3 && g3))
        return false;
      const m2 = s3.container.getBoundingClientRect();
      p3 += m2.left, u3 += m2.top;
      const v2 = -1 * (p3 + 0.5 * f3 - (c3 + 0.5 * h3)), b3 = -1 * (u3 + 0.5 * g3 - (l3 + 0.5 * d3)), y2 = h3 / f3;
      let w2 = this.option("zoomOpacity") || false;
      return w2 === "auto" && (w2 = Math.abs(h3 / d3 - f3 / g3) > 0.1), { x: v2, y: b3, scale: y2, opacity: w2 };
    }
    attach() {
      const t3 = this, e3 = t3.instance;
      e3.on("Carousel.change", t3.onChange), e3.on("Carousel.createSlide", t3.onCreateSlide), e3.on("Carousel.removeSlide", t3.onRemoveSlide), e3.on("close", t3.onClose);
    }
    detach() {
      const t3 = this, e3 = t3.instance;
      e3.off("Carousel.change", t3.onChange), e3.off("Carousel.createSlide", t3.onCreateSlide), e3.off("Carousel.removeSlide", t3.onRemoveSlide), e3.off("close", t3.onClose);
    }
  };
  Object.defineProperty(yt, "defaults", { enumerable: true, configurable: true, writable: true, value: { initialSize: "fit", Panzoom: { maxScale: 1 }, protected: false, zoom: true, zoomOpacity: "auto" } }), typeof SuppressedError == "function" && SuppressedError;
  var wt = "html";
  var xt = "image";
  var Et = "map";
  var St = "youtube";
  var Pt = "vimeo";
  var Ct = "html5video";
  var Tt = (t3, e3 = {}) => {
    const i3 = new URL(t3), n3 = new URLSearchParams(i3.search), s3 = new URLSearchParams();
    for (const [t4, i4] of [...n3, ...Object.entries(e3)]) {
      let e4 = i4 + "";
      if (t4 === "t") {
        let t5 = e4.match(/((\d*)m)?(\d*)s?/);
        t5 && s3.set("start", 60 * parseInt(t5[2] || "0") + parseInt(t5[3] || "0") + "");
      } else
        s3.set(t4, e4);
    }
    let o3 = s3 + "", a3 = t3.match(/#t=((.*)?\d+s)/);
    return a3 && (o3 += `#t=${a3[1]}`), o3;
  };
  var Mt = { ajax: null, autoSize: true, iframeAttr: { allow: "autoplay; fullscreen", scrolling: "auto" }, preload: true, videoAutoplay: true, videoRatio: 16 / 9, videoTpl: `<video class="fancybox__html5video" playsinline controls controlsList="nodownload" poster="{{poster}}">
  <source src="{{src}}" type="{{format}}" />Sorry, your browser doesn't support embedded videos.</video>`, videoFormat: "", vimeo: { byline: 1, color: "00adef", controls: 1, dnt: 1, muted: 0 }, youtube: { controls: 1, enablejsapi: 1, nocookie: 1, rel: 0, fs: 1 } };
  var Ot = ["image", "html", "ajax", "inline", "clone", "iframe", "map", "pdf", "html5video", "youtube", "vimeo"];
  var At = class extends N {
    onBeforeInitSlide(t3, e3, i3) {
      this.processType(i3);
    }
    onCreateSlide(t3, e3, i3) {
      this.setContent(i3);
    }
    onClearContent(t3, e3) {
      e3.xhr && (e3.xhr.abort(), e3.xhr = null);
      const i3 = e3.iframeEl;
      i3 && (i3.onload = i3.onerror = null, i3.src = "//about:blank", e3.iframeEl = null);
      const n3 = e3.contentEl, s3 = e3.placeholderEl;
      if (e3.type === "inline" && n3 && s3)
        n3.classList.remove("fancybox__content"), n3.style.display !== "none" && (n3.style.display = "none"), s3.parentNode && s3.parentNode.insertBefore(n3, s3), s3.remove(), e3.contentEl = void 0, e3.placeholderEl = void 0;
      else
        for (; e3.el && e3.el.firstChild; )
          e3.el.removeChild(e3.el.firstChild);
    }
    onSelectSlide(t3, e3, i3) {
      i3.state === rt.Ready && this.playVideo();
    }
    onUnselectSlide(t3, e3, i3) {
      var n3, s3;
      if (i3.type === Ct) {
        try {
          (s3 = (n3 = i3.el) === null || n3 === void 0 ? void 0 : n3.querySelector("video")) === null || s3 === void 0 || s3.pause();
        } catch (t4) {
        }
        return;
      }
      let o3;
      i3.type === Pt ? o3 = { method: "pause", value: "true" } : i3.type === St && (o3 = { event: "command", func: "pauseVideo" }), o3 && i3.iframeEl && i3.iframeEl.contentWindow && i3.iframeEl.contentWindow.postMessage(JSON.stringify(o3), "*"), i3.poller && clearTimeout(i3.poller);
    }
    onDone(t3, e3) {
      t3.isCurrentSlide(e3) && !t3.isClosing() && this.playVideo();
    }
    onRefresh(t3, e3) {
      e3.slides.forEach((t4) => {
        t4.el && (this.resizeIframe(t4), this.setAspectRatio(t4));
      });
    }
    onMessage(t3) {
      try {
        let e3 = JSON.parse(t3.data);
        if (t3.origin === "https://player.vimeo.com") {
          if (e3.event === "ready")
            for (let e4 of Array.from(document.getElementsByClassName("fancybox__iframe")))
              e4 instanceof HTMLIFrameElement && e4.contentWindow === t3.source && (e4.dataset.ready = "true");
        } else if (t3.origin.match(/^https:\/\/(www.)?youtube(-nocookie)?.com$/) && e3.event === "onReady") {
          const t4 = document.getElementById(e3.id);
          t4 && (t4.dataset.ready = "true");
        }
      } catch (t4) {
      }
    }
    loadAjaxContent(t3) {
      const e3 = this.instance.optionFor(t3, "src") || "";
      this.instance.showLoading(t3);
      const i3 = this.instance, n3 = new XMLHttpRequest();
      i3.showLoading(t3), n3.onreadystatechange = function() {
        n3.readyState === XMLHttpRequest.DONE && i3.state === at.Ready && (i3.hideLoading(t3), n3.status === 200 ? i3.setContent(t3, n3.responseText) : i3.setError(t3, n3.status === 404 ? "{{AJAX_NOT_FOUND}}" : "{{AJAX_FORBIDDEN}}"));
      };
      const s3 = t3.ajax || null;
      n3.open(s3 ? "POST" : "GET", e3 + ""), n3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), n3.setRequestHeader("X-Requested-With", "XMLHttpRequest"), n3.send(s3), t3.xhr = n3;
    }
    setInlineContent(t3) {
      let e3 = null;
      if (E(t3.src))
        e3 = t3.src;
      else if (typeof t3.src == "string") {
        const i3 = t3.src.split("#", 2).pop();
        e3 = i3 ? document.getElementById(i3) : null;
      }
      if (e3) {
        if (t3.type === "clone" || e3.closest(".fancybox__slide")) {
          e3 = e3.cloneNode(true);
          const i3 = e3.dataset.animationName;
          i3 && (e3.classList.remove(i3), delete e3.dataset.animationName);
          let n3 = e3.getAttribute("id");
          n3 = n3 ? `${n3}--clone` : `clone-${this.instance.id}-${t3.index}`, e3.setAttribute("id", n3);
        } else if (e3.parentNode) {
          const i3 = document.createElement("div");
          i3.classList.add("fancybox-placeholder"), e3.parentNode.insertBefore(i3, e3), t3.placeholderEl = i3;
        }
        this.instance.setContent(t3, e3);
      } else
        this.instance.setError(t3, "{{ELEMENT_NOT_FOUND}}");
    }
    setIframeContent(t3) {
      const { src: e3, el: i3 } = t3;
      if (!e3 || typeof e3 != "string" || !i3)
        return;
      i3.classList.add("is-loading");
      const n3 = this.instance, s3 = document.createElement("iframe");
      s3.className = "fancybox__iframe", s3.setAttribute("id", `fancybox__iframe_${n3.id}_${t3.index}`);
      for (const [e4, i4] of Object.entries(this.optionFor(t3, "iframeAttr") || {}))
        s3.setAttribute(e4, i4);
      s3.onerror = () => {
        n3.setError(t3, "{{IFRAME_ERROR}}");
      }, t3.iframeEl = s3;
      const o3 = this.optionFor(t3, "preload");
      if (t3.type !== "iframe" || o3 === false)
        return s3.setAttribute("src", t3.src + ""), n3.setContent(t3, s3, false), this.resizeIframe(t3), void n3.revealContent(t3);
      n3.showLoading(t3), s3.onload = () => {
        if (!s3.src.length)
          return;
        const e4 = s3.dataset.ready !== "true";
        s3.dataset.ready = "true", this.resizeIframe(t3), e4 ? n3.revealContent(t3) : n3.hideLoading(t3);
      }, s3.setAttribute("src", e3), n3.setContent(t3, s3, false);
    }
    resizeIframe(t3) {
      const { type: e3, iframeEl: i3 } = t3;
      if (e3 === St || e3 === Pt)
        return;
      const n3 = i3 == null ? void 0 : i3.parentElement;
      if (!i3 || !n3)
        return;
      let s3 = t3.autoSize;
      s3 === void 0 && (s3 = this.optionFor(t3, "autoSize"));
      let o3 = t3.width || 0, a3 = t3.height || 0;
      o3 && a3 && (s3 = false);
      const r3 = n3 && n3.style;
      if (t3.preload !== false && s3 !== false && r3)
        try {
          const t4 = window.getComputedStyle(n3), e4 = parseFloat(t4.paddingLeft) + parseFloat(t4.paddingRight), s4 = parseFloat(t4.paddingTop) + parseFloat(t4.paddingBottom), l3 = i3.contentWindow;
          if (l3) {
            const t5 = l3.document, i4 = t5.getElementsByTagName(wt)[0], n4 = t5.body;
            r3.width = "", n4.style.overflow = "hidden", o3 = o3 || i4.scrollWidth + e4, r3.width = `${o3}px`, n4.style.overflow = "", r3.flex = "0 0 auto", r3.height = `${n4.scrollHeight}px`, a3 = i4.scrollHeight + s4;
          }
        } catch (t4) {
        }
      if (o3 || a3) {
        const t4 = { flex: "0 1 auto", width: "", height: "" };
        o3 && o3 !== "auto" && (t4.width = `${o3}px`), a3 && a3 !== "auto" && (t4.height = `${a3}px`), Object.assign(r3, t4);
      }
    }
    playVideo() {
      const t3 = this.instance.getSlide();
      if (!t3)
        return;
      const { el: e3 } = t3;
      if (!e3 || !e3.offsetParent)
        return;
      if (!this.optionFor(t3, "videoAutoplay"))
        return;
      if (t3.type === Ct)
        try {
          const t4 = e3.querySelector("video");
          if (t4) {
            const e4 = t4.play();
            e4 !== void 0 && e4.then(() => {
            }).catch((e5) => {
              t4.muted = true, t4.play();
            });
          }
        } catch (t4) {
        }
      if (t3.type !== St && t3.type !== Pt)
        return;
      const i3 = () => {
        if (t3.iframeEl && t3.iframeEl.contentWindow) {
          let e4;
          if (t3.iframeEl.dataset.ready === "true")
            return e4 = t3.type === St ? { event: "command", func: "playVideo" } : { method: "play", value: "true" }, e4 && t3.iframeEl.contentWindow.postMessage(JSON.stringify(e4), "*"), void (t3.poller = void 0);
          t3.type === St && (e4 = { event: "listening", id: t3.iframeEl.getAttribute("id") }, t3.iframeEl.contentWindow.postMessage(JSON.stringify(e4), "*"));
        }
        t3.poller = setTimeout(i3, 250);
      };
      i3();
    }
    processType(t3) {
      if (t3.html)
        return t3.type = wt, t3.src = t3.html, void (t3.html = "");
      const e3 = this.instance.optionFor(t3, "src", "");
      if (!e3 || typeof e3 != "string")
        return;
      let i3 = t3.type, n3 = null;
      if (n3 = e3.match(/(youtube\.com|youtu\.be|youtube\-nocookie\.com)\/(?:watch\?(?:.*&)?v=|v\/|u\/|shorts\/|embed\/?)?(videoseries\?list=(?:.*)|[\w-]{11}|\?listType=(?:.*)&list=(?:.*))(?:.*)/i)) {
        const s3 = this.optionFor(t3, St), { nocookie: o3 } = s3, a3 = function(t4, e4) {
          var i4 = {};
          for (var n4 in t4)
            Object.prototype.hasOwnProperty.call(t4, n4) && e4.indexOf(n4) < 0 && (i4[n4] = t4[n4]);
          if (t4 != null && typeof Object.getOwnPropertySymbols == "function") {
            var s4 = 0;
            for (n4 = Object.getOwnPropertySymbols(t4); s4 < n4.length; s4++)
              e4.indexOf(n4[s4]) < 0 && Object.prototype.propertyIsEnumerable.call(t4, n4[s4]) && (i4[n4[s4]] = t4[n4[s4]]);
          }
          return i4;
        }(s3, ["nocookie"]), r3 = `www.youtube${o3 ? "-nocookie" : ""}.com`, l3 = Tt(e3, a3), c3 = encodeURIComponent(n3[2]);
        t3.videoId = c3, t3.src = `https://${r3}/embed/${c3}?${l3}`, t3.thumbSrc = t3.thumbSrc || `https://i.ytimg.com/vi/${c3}/mqdefault.jpg`, i3 = St;
      } else if (n3 = e3.match(/^.+vimeo.com\/(?:\/)?([\d]+)((\/|\?h=)([a-z0-9]+))?(.*)?/)) {
        const s3 = Tt(e3, this.optionFor(t3, Pt)), o3 = encodeURIComponent(n3[1]), a3 = n3[4] || "";
        t3.videoId = o3, t3.src = `https://player.vimeo.com/video/${o3}?${a3 ? `h=${a3}${s3 ? "&" : ""}` : ""}${s3}`, i3 = Pt;
      }
      if (!i3 && t3.triggerEl) {
        const e4 = t3.triggerEl.dataset.type;
        Ot.includes(e4) && (i3 = e4);
      }
      i3 || typeof e3 == "string" && (e3.charAt(0) === "#" ? i3 = "inline" : (n3 = e3.match(/\.(mp4|mov|ogv|webm)((\?|#).*)?$/i)) ? (i3 = Ct, t3.videoFormat = t3.videoFormat || "video/" + (n3[1] === "ogv" ? "ogg" : n3[1])) : e3.match(/(^data:image\/[a-z0-9+\/=]*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg|ico)((\?|#).*)?$)/i) ? i3 = xt : e3.match(/\.(pdf)((\?|#).*)?$/i) && (i3 = "pdf")), (n3 = e3.match(/(?:maps\.)?google\.([a-z]{2,3}(?:\.[a-z]{2})?)\/(?:(?:(?:maps\/(?:place\/(?:.*)\/)?\@(.*),(\d+.?\d+?)z))|(?:\?ll=))(.*)?/i)) ? (t3.src = `https://maps.google.${n3[1]}/?ll=${(n3[2] ? n3[2] + "&z=" + Math.floor(parseFloat(n3[3])) + (n3[4] ? n3[4].replace(/^\//, "&") : "") : n3[4] + "").replace(/\?/, "&")}&output=${n3[4] && n3[4].indexOf("layer=c") > 0 ? "svembed" : "embed"}`, i3 = Et) : (n3 = e3.match(/(?:maps\.)?google\.([a-z]{2,3}(?:\.[a-z]{2})?)\/(?:maps\/search\/)(.*)/i)) && (t3.src = `https://maps.google.${n3[1]}/maps?q=${n3[2].replace("query=", "q=").replace("api=1", "")}&output=embed`, i3 = Et), i3 = i3 || this.instance.option("defaultType"), t3.type = i3, i3 === xt && (t3.thumbSrc = t3.thumbSrc || t3.src);
    }
    setContent(t3) {
      const e3 = this.instance.optionFor(t3, "src") || "";
      if (t3 && t3.type && e3) {
        switch (t3.type) {
          case wt:
            this.instance.setContent(t3, e3);
            break;
          case Ct:
            const i3 = this.option("videoTpl");
            i3 && this.instance.setContent(t3, i3.replace(/\{\{src\}\}/gi, e3 + "").replace(/\{\{format\}\}/gi, this.optionFor(t3, "videoFormat") || "").replace(/\{\{poster\}\}/gi, t3.poster || t3.thumbSrc || ""));
            break;
          case "inline":
          case "clone":
            this.setInlineContent(t3);
            break;
          case "ajax":
            this.loadAjaxContent(t3);
            break;
          case "pdf":
          case Et:
          case St:
          case Pt:
            t3.preload = false;
          case "iframe":
            this.setIframeContent(t3);
        }
        this.setAspectRatio(t3);
      }
    }
    setAspectRatio(t3) {
      const e3 = t3.contentEl;
      if (!(t3.el && e3 && t3.type && [St, Pt, Ct].includes(t3.type)))
        return;
      let i3, n3 = t3.width || "auto", s3 = t3.height || "auto";
      if (n3 === "auto" || s3 === "auto") {
        i3 = this.optionFor(t3, "videoRatio");
        const e4 = (i3 + "").match(/(\d+)\s*\/\s?(\d+)/);
        i3 = e4 && e4.length > 2 ? parseFloat(e4[1]) / parseFloat(e4[2]) : parseFloat(i3 + "");
      } else
        n3 && s3 && (i3 = n3 / s3);
      if (!i3)
        return;
      e3.style.aspectRatio = "", e3.style.width = "", e3.style.height = "", e3.offsetHeight;
      const o3 = e3.getBoundingClientRect(), a3 = o3.width || 1, r3 = o3.height || 1;
      e3.style.aspectRatio = i3 + "", i3 < a3 / r3 ? (s3 = s3 === "auto" ? r3 : Math.min(r3, s3), e3.style.width = "auto", e3.style.height = `${s3}px`) : (n3 = n3 === "auto" ? a3 : Math.min(a3, n3), e3.style.width = `${n3}px`, e3.style.height = "auto");
    }
    attach() {
      const t3 = this, e3 = t3.instance;
      e3.on("Carousel.beforeInitSlide", t3.onBeforeInitSlide), e3.on("Carousel.createSlide", t3.onCreateSlide), e3.on("Carousel.selectSlide", t3.onSelectSlide), e3.on("Carousel.unselectSlide", t3.onUnselectSlide), e3.on("Carousel.Panzoom.refresh", t3.onRefresh), e3.on("done", t3.onDone), e3.on("clearContent", t3.onClearContent), window.addEventListener("message", t3.onMessage);
    }
    detach() {
      const t3 = this, e3 = t3.instance;
      e3.off("Carousel.beforeInitSlide", t3.onBeforeInitSlide), e3.off("Carousel.createSlide", t3.onCreateSlide), e3.off("Carousel.selectSlide", t3.onSelectSlide), e3.off("Carousel.unselectSlide", t3.onUnselectSlide), e3.off("Carousel.Panzoom.refresh", t3.onRefresh), e3.off("done", t3.onDone), e3.off("clearContent", t3.onClearContent), window.removeEventListener("message", t3.onMessage);
    }
  };
  Object.defineProperty(At, "defaults", { enumerable: true, configurable: true, writable: true, value: Mt });
  var Lt = "play";
  var zt = "pause";
  var Rt = "ready";
  var kt = class extends N {
    constructor() {
      super(...arguments), Object.defineProperty(this, "state", { enumerable: true, configurable: true, writable: true, value: Rt }), Object.defineProperty(this, "inHover", { enumerable: true, configurable: true, writable: true, value: false }), Object.defineProperty(this, "timer", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "progressBar", { enumerable: true, configurable: true, writable: true, value: null });
    }
    get isActive() {
      return this.state !== Rt;
    }
    onReady(t3) {
      this.option("autoStart") && (t3.isInfinite || t3.page < t3.pages.length - 1) && this.start();
    }
    onChange() {
      this.removeProgressBar(), this.pause();
    }
    onSettle() {
      this.resume();
    }
    onVisibilityChange() {
      document.visibilityState === "visible" ? this.resume() : this.pause();
    }
    onMouseEnter() {
      this.inHover = true, this.pause();
    }
    onMouseLeave() {
      var t3;
      this.inHover = false, ((t3 = this.instance.panzoom) === null || t3 === void 0 ? void 0 : t3.isResting) && this.resume();
    }
    onTimerEnd() {
      const t3 = this.instance;
      this.state === "play" && (t3.isInfinite || t3.page !== t3.pages.length - 1 ? t3.slideNext() : t3.slideTo(0));
    }
    removeProgressBar() {
      this.progressBar && (this.progressBar.remove(), this.progressBar = null);
    }
    createProgressBar() {
      var t3;
      if (!this.option("showProgress"))
        return null;
      this.removeProgressBar();
      const e3 = this.instance, i3 = ((t3 = e3.pages[e3.page]) === null || t3 === void 0 ? void 0 : t3.slides) || [];
      let n3 = this.option("progressParentEl");
      if (n3 || (n3 = (i3.length === 1 ? i3[0].el : null) || e3.viewport), !n3)
        return null;
      const s3 = document.createElement("div");
      return P(s3, "f-progress"), n3.prepend(s3), this.progressBar = s3, s3.offsetHeight, s3;
    }
    set() {
      const t3 = this, e3 = t3.instance;
      if (e3.pages.length < 2)
        return;
      if (t3.timer)
        return;
      const i3 = t3.option("timeout");
      t3.state = Lt, P(e3.container, "has-autoplay");
      let n3 = t3.createProgressBar();
      n3 && (n3.style.transitionDuration = `${i3}ms`, n3.style.transform = "scaleX(1)"), t3.timer = setTimeout(() => {
        t3.timer = null, t3.inHover || t3.onTimerEnd();
      }, i3), t3.emit("set");
    }
    clear() {
      const t3 = this;
      t3.timer && (clearTimeout(t3.timer), t3.timer = null), t3.removeProgressBar();
    }
    start() {
      const t3 = this;
      if (t3.set(), t3.state !== Rt) {
        if (t3.option("pauseOnHover")) {
          const e3 = t3.instance.container;
          e3.addEventListener("mouseenter", t3.onMouseEnter, false), e3.addEventListener("mouseleave", t3.onMouseLeave, false);
        }
        document.addEventListener("visibilitychange", t3.onVisibilityChange, false), t3.emit("start");
      }
    }
    stop() {
      const t3 = this, e3 = t3.state, i3 = t3.instance.container;
      t3.clear(), t3.state = Rt, i3.removeEventListener("mouseenter", t3.onMouseEnter, false), i3.removeEventListener("mouseleave", t3.onMouseLeave, false), document.removeEventListener("visibilitychange", t3.onVisibilityChange, false), S(i3, "has-autoplay"), e3 !== Rt && t3.emit("stop");
    }
    pause() {
      const t3 = this;
      t3.state === Lt && (t3.state = zt, t3.clear(), t3.emit(zt));
    }
    resume() {
      const t3 = this, e3 = t3.instance;
      if (e3.isInfinite || e3.page !== e3.pages.length - 1)
        if (t3.state !== Lt) {
          if (t3.state === zt && !t3.inHover) {
            const e4 = new Event("resume", { bubbles: true, cancelable: true });
            t3.emit("resume", e4), e4.defaultPrevented || t3.set();
          }
        } else
          t3.set();
      else
        t3.stop();
    }
    toggle() {
      this.state === Lt || this.state === zt ? this.stop() : this.start();
    }
    attach() {
      const t3 = this, e3 = t3.instance;
      e3.on("ready", t3.onReady), e3.on("Panzoom.startAnimation", t3.onChange), e3.on("Panzoom.endAnimation", t3.onSettle), e3.on("Panzoom.touchMove", t3.onChange);
    }
    detach() {
      const t3 = this, e3 = t3.instance;
      e3.off("ready", t3.onReady), e3.off("Panzoom.startAnimation", t3.onChange), e3.off("Panzoom.endAnimation", t3.onSettle), e3.off("Panzoom.touchMove", t3.onChange), t3.stop();
    }
  };
  Object.defineProperty(kt, "defaults", { enumerable: true, configurable: true, writable: true, value: { autoStart: true, pauseOnHover: true, progressParentEl: null, showProgress: true, timeout: 3e3 } });
  var It = class extends N {
    constructor() {
      super(...arguments), Object.defineProperty(this, "ref", { enumerable: true, configurable: true, writable: true, value: null });
    }
    onPrepare(t3) {
      const e3 = t3.carousel;
      if (!e3)
        return;
      const i3 = t3.container;
      i3 && (e3.options.Autoplay = u({ autoStart: false }, this.option("Autoplay") || {}, { pauseOnHover: false, timeout: this.option("timeout"), progressParentEl: () => this.option("progressParentEl") || null, on: { start: () => {
        t3.emit("startSlideshow");
      }, set: (e4) => {
        var n3;
        i3.classList.add("has-slideshow"), ((n3 = t3.getSlide()) === null || n3 === void 0 ? void 0 : n3.state) !== rt.Ready && e4.pause();
      }, stop: () => {
        i3.classList.remove("has-slideshow"), t3.isCompact || t3.endIdle(), t3.emit("endSlideshow");
      }, resume: (e4, i4) => {
        var n3, s3, o3;
        !i4 || !i4.cancelable || ((n3 = t3.getSlide()) === null || n3 === void 0 ? void 0 : n3.state) === rt.Ready && ((o3 = (s3 = t3.carousel) === null || s3 === void 0 ? void 0 : s3.panzoom) === null || o3 === void 0 ? void 0 : o3.isResting) || i4.preventDefault();
      } } }), e3.attachPlugins({ Autoplay: kt }), this.ref = e3.plugins.Autoplay);
    }
    onReady(t3) {
      const e3 = t3.carousel, i3 = this.ref;
      i3 && e3 && this.option("playOnStart") && (e3.isInfinite || e3.page < e3.pages.length - 1) && i3.start();
    }
    onDone(t3, e3) {
      const i3 = this.ref, n3 = t3.carousel;
      if (!i3 || !n3)
        return;
      const s3 = e3.panzoom;
      s3 && s3.on("startAnimation", () => {
        t3.isCurrentSlide(e3) && i3.stop();
      }), t3.isCurrentSlide(e3) && i3.resume();
    }
    onKeydown(t3, e3) {
      var i3;
      const n3 = this.ref;
      n3 && e3 === this.option("key") && ((i3 = document.activeElement) === null || i3 === void 0 ? void 0 : i3.nodeName) !== "BUTTON" && n3.toggle();
    }
    attach() {
      const t3 = this, e3 = t3.instance;
      e3.on("Carousel.init", t3.onPrepare), e3.on("Carousel.ready", t3.onReady), e3.on("done", t3.onDone), e3.on("keydown", t3.onKeydown);
    }
    detach() {
      const t3 = this, e3 = t3.instance;
      e3.off("Carousel.init", t3.onPrepare), e3.off("Carousel.ready", t3.onReady), e3.off("done", t3.onDone), e3.off("keydown", t3.onKeydown);
    }
  };
  Object.defineProperty(It, "defaults", { enumerable: true, configurable: true, writable: true, value: { key: " ", playOnStart: false, progressParentEl: (t3) => {
    var e3;
    return ((e3 = t3.instance.container) === null || e3 === void 0 ? void 0 : e3.querySelector(".fancybox__toolbar [data-fancybox-toggle-slideshow]")) || t3.instance.container;
  }, timeout: 3e3 } });
  var Dt = { classes: { container: "f-thumbs f-carousel__thumbs", viewport: "f-thumbs__viewport", track: "f-thumbs__track", slide: "f-thumbs__slide", isResting: "is-resting", isSelected: "is-selected", isLoading: "is-loading", hasThumbs: "has-thumbs" }, minCount: 2, parentEl: null, thumbTpl: '<button class="f-thumbs__slide__button" tabindex="0" type="button" aria-label="{{GOTO}}" data-carousel-index="%i"><img class="f-thumbs__slide__img" data-lazy-src="{{%s}}" alt="" /></button>', type: "modern" };
  var Ft;
  !function(t3) {
    t3[t3.Init = 0] = "Init", t3[t3.Ready = 1] = "Ready", t3[t3.Hidden = 2] = "Hidden";
  }(Ft || (Ft = {}));
  var jt = "isResting";
  var Bt = "thumbWidth";
  var Ht = "thumbHeight";
  var Nt = "thumbClipWidth";
  var _t = class extends N {
    constructor() {
      super(...arguments), Object.defineProperty(this, "type", { enumerable: true, configurable: true, writable: true, value: "modern" }), Object.defineProperty(this, "container", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "track", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "carousel", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "thumbWidth", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "thumbClipWidth", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "thumbHeight", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "thumbGap", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "thumbExtraGap", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "state", { enumerable: true, configurable: true, writable: true, value: Ft.Init });
    }
    get isModern() {
      return this.type === "modern";
    }
    onInitSlide(t3, e3) {
      const i3 = e3.el ? e3.el.dataset : void 0;
      i3 && (e3.thumbSrc = i3.thumbSrc || e3.thumbSrc || "", e3[Nt] = parseFloat(i3[Nt] || "") || e3[Nt] || 0, e3[Ht] = parseFloat(i3.thumbHeight || "") || e3[Ht] || 0), this.addSlide(e3);
    }
    onInitSlides() {
      this.build();
    }
    onChange() {
      var t3;
      if (!this.isModern)
        return;
      const e3 = this.container, i3 = this.instance, n3 = i3.panzoom, s3 = this.carousel, a3 = s3 ? s3.panzoom : null, r3 = i3.page;
      if (n3 && s3 && a3) {
        if (n3.isDragging) {
          S(e3, this.cn(jt));
          let n4 = ((t3 = s3.pages[r3]) === null || t3 === void 0 ? void 0 : t3.pos) || 0;
          n4 += i3.getProgress(r3) * (this[Nt] + this.thumbGap);
          let o3 = a3.getBounds();
          -1 * n4 > o3.x.min && -1 * n4 < o3.x.max && a3.panTo({ x: -1 * n4, friction: 0.12 });
        } else
          o(e3, this.cn(jt), n3.isResting);
        this.shiftModern();
      }
    }
    onRefresh() {
      this.updateProps();
      for (const t3 of this.instance.slides || [])
        this.resizeModernSlide(t3);
      this.shiftModern();
    }
    isDisabled() {
      const t3 = this.option("minCount") || 0;
      if (t3) {
        const e4 = this.instance;
        let i3 = 0;
        for (const t4 of e4.slides || [])
          t4.thumbSrc && i3++;
        if (i3 < t3)
          return true;
      }
      const e3 = this.option("type");
      return ["modern", "classic"].indexOf(e3) < 0;
    }
    getThumb(t3) {
      const e3 = this.option("thumbTpl") || "";
      return { html: this.instance.localize(e3, [["%i", t3.index], ["%d", t3.index + 1], ["%s", t3.thumbSrc || "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"]]) };
    }
    addSlide(t3) {
      const e3 = this.carousel;
      e3 && e3.addSlide(t3.index, this.getThumb(t3));
    }
    getSlides() {
      const t3 = [];
      for (const e3 of this.instance.slides || [])
        t3.push(this.getThumb(e3));
      return t3;
    }
    resizeModernSlide(t3) {
      this.isModern && (t3[Bt] = t3[Nt] && t3[Ht] ? Math.round(this[Ht] * (t3[Nt] / t3[Ht])) : this[Bt]);
    }
    updateProps() {
      const t3 = this.container;
      if (!t3)
        return;
      const e3 = (e4) => parseFloat(getComputedStyle(t3).getPropertyValue("--f-thumb-" + e4)) || 0;
      this.thumbGap = e3("gap"), this.thumbExtraGap = e3("extra-gap"), this[Bt] = e3("width") || 40, this[Nt] = e3("clip-width") || 40, this[Ht] = e3("height") || 40;
    }
    build() {
      const t3 = this;
      if (t3.state !== Ft.Init)
        return;
      if (t3.isDisabled())
        return void t3.emit("disabled");
      const e3 = t3.instance, i3 = e3.container, n3 = t3.getSlides(), s3 = t3.option("type");
      t3.type = s3;
      const o3 = t3.option("parentEl"), a3 = t3.cn("container"), r3 = t3.cn("track");
      let l3 = o3 == null ? void 0 : o3.querySelector("." + a3);
      l3 || (l3 = document.createElement("div"), P(l3, a3), o3 ? o3.appendChild(l3) : i3.after(l3)), P(l3, `is-${s3}`), P(i3, t3.cn("hasThumbs")), t3.container = l3, t3.updateProps();
      let c3 = l3.querySelector("." + r3);
      c3 || (c3 = document.createElement("div"), P(c3, t3.cn("track")), l3.appendChild(c3)), t3.track = c3;
      const h3 = u({}, { track: c3, infinite: false, center: true, fill: s3 === "classic", dragFree: true, slidesPerPage: 1, transition: false, preload: 0.25, friction: 0.12, Panzoom: { maxVelocity: 0 }, Dots: false, Navigation: false, classes: { container: "f-thumbs", viewport: "f-thumbs__viewport", track: "f-thumbs__track", slide: "f-thumbs__slide" } }, t3.option("Carousel") || {}, { Sync: { target: e3 }, slides: n3 }), d3 = new e3.constructor(l3, h3);
      d3.on("createSlide", (e4, i4) => {
        t3.setProps(i4.index), t3.emit("createSlide", i4, i4.el);
      }), d3.on("ready", () => {
        t3.shiftModern(), t3.emit("ready");
      }), d3.on("refresh", () => {
        t3.shiftModern();
      }), d3.on("Panzoom.click", (e4, i4, n4) => {
        t3.onClick(n4);
      }), t3.carousel = d3, t3.state = Ft.Ready;
    }
    onClick(t3) {
      t3.preventDefault(), t3.stopPropagation();
      const e3 = this.instance, { pages: i3, page: n3 } = e3, s3 = (t4) => {
        if (t4) {
          const e4 = t4.closest("[data-carousel-index]");
          if (e4)
            return [parseInt(e4.dataset.carouselIndex || "", 10) || 0, e4];
        }
        return [-1, void 0];
      }, o3 = (t4, e4) => {
        const i4 = document.elementFromPoint(t4, e4);
        return i4 ? s3(i4) : [-1, void 0];
      };
      let [a3, r3] = s3(t3.target);
      if (a3 > -1)
        return;
      const l3 = this[Nt], c3 = t3.clientX, h3 = t3.clientY;
      let [d3, u3] = o3(c3 - l3, h3), [p3, f3] = o3(c3 + l3, h3);
      u3 && f3 ? (a3 = Math.abs(c3 - u3.getBoundingClientRect().right) < Math.abs(c3 - f3.getBoundingClientRect().left) ? d3 : p3, a3 === n3 && (a3 = a3 === d3 ? p3 : d3)) : u3 ? a3 = d3 : f3 && (a3 = p3), a3 > -1 && i3[a3] && e3.slideTo(a3);
    }
    getShift(t3) {
      var e3;
      const i3 = this, { instance: n3 } = i3, s3 = i3.carousel;
      if (!n3 || !s3)
        return 0;
      const o3 = i3[Bt], a3 = i3[Nt], r3 = i3.thumbGap, l3 = i3.thumbExtraGap;
      if (!((e3 = s3.slides[t3]) === null || e3 === void 0 ? void 0 : e3.el))
        return 0;
      const c3 = 0.5 * (o3 - a3), h3 = n3.pages.length - 1;
      let d3 = n3.getProgress(0), u3 = n3.getProgress(h3), p3 = n3.getProgress(t3, false, true), f3 = 0, g3 = c3 + l3 + r3;
      const m2 = d3 < 0 && d3 > -1, v2 = u3 > 0 && u3 < 1;
      return t3 === 0 ? (f3 = g3 * Math.abs(d3), v2 && d3 === 1 && (f3 -= g3 * Math.abs(u3))) : t3 === h3 ? (f3 = g3 * Math.abs(u3) * -1, m2 && u3 === -1 && (f3 += g3 * Math.abs(d3))) : m2 || v2 ? (f3 = -1 * g3, f3 += g3 * Math.abs(d3), f3 += g3 * (1 - Math.abs(u3))) : f3 = g3 * p3, f3;
    }
    setProps(e3) {
      var i3;
      const n3 = this;
      if (!n3.isModern)
        return;
      const { instance: s3 } = n3, o3 = n3.carousel;
      if (s3 && o3) {
        const a3 = (i3 = o3.slides[e3]) === null || i3 === void 0 ? void 0 : i3.el;
        if (a3 && a3.childNodes.length) {
          let i4 = t(1 - Math.abs(s3.getProgress(e3))), o4 = t(n3.getShift(e3));
          a3.style.setProperty("--progress", i4 ? i4 + "" : ""), a3.style.setProperty("--shift", o4 + "");
        }
      }
    }
    shiftModern() {
      const t3 = this;
      if (!t3.isModern)
        return;
      const { instance: e3, track: i3 } = t3, n3 = e3.panzoom, s3 = t3.carousel;
      if (!(e3 && i3 && n3 && s3))
        return;
      if (n3.state === m.Init || n3.state === m.Destroy)
        return;
      for (const i4 of e3.slides)
        t3.setProps(i4.index);
      let o3 = (t3[Nt] + t3.thumbGap) * (s3.slides.length || 0);
      i3.style.setProperty("--width", o3 + "");
    }
    cleanup() {
      const t3 = this;
      t3.carousel && t3.carousel.destroy(), t3.carousel = null, t3.container && t3.container.remove(), t3.container = null, t3.track && t3.track.remove(), t3.track = null, t3.state = Ft.Init, S(t3.instance.container, t3.cn("hasThumbs"));
    }
    attach() {
      const t3 = this, e3 = t3.instance;
      e3.on("initSlide", t3.onInitSlide), e3.state === j.Init ? e3.on("initSlides", t3.onInitSlides) : t3.onInitSlides(), e3.on(["change", "Panzoom.afterTransform"], t3.onChange), e3.on("Panzoom.refresh", t3.onRefresh);
    }
    detach() {
      const t3 = this, e3 = t3.instance;
      e3.off("initSlide", t3.onInitSlide), e3.off("initSlides", t3.onInitSlides), e3.off(["change", "Panzoom.afterTransform"], t3.onChange), e3.off("Panzoom.refresh", t3.onRefresh), t3.cleanup();
    }
  };
  Object.defineProperty(_t, "defaults", { enumerable: true, configurable: true, writable: true, value: Dt });
  var $t = Object.assign(Object.assign({}, Dt), { key: "t", showOnStart: true, parentEl: null });
  var Wt = "is-masked";
  var Xt = "aria-hidden";
  var qt = class extends N {
    constructor() {
      super(...arguments), Object.defineProperty(this, "ref", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "hidden", { enumerable: true, configurable: true, writable: true, value: false });
    }
    get isEnabled() {
      const t3 = this.ref;
      return t3 && !t3.isDisabled();
    }
    get isHidden() {
      return this.hidden;
    }
    onClick(t3, e3) {
      e3.stopPropagation();
    }
    onCreateSlide(t3, e3) {
      var i3, n3, s3;
      const o3 = ((s3 = (n3 = (i3 = this.instance) === null || i3 === void 0 ? void 0 : i3.carousel) === null || n3 === void 0 ? void 0 : n3.slides[e3.index]) === null || s3 === void 0 ? void 0 : s3.type) || "", a3 = e3.el;
      if (a3 && o3) {
        let t4 = `for-${o3}`;
        ["video", "youtube", "vimeo", "html5video"].includes(o3) && (t4 += " for-video"), P(a3, t4);
      }
    }
    onInit() {
      var t3;
      const e3 = this, i3 = e3.instance, n3 = i3.carousel;
      if (e3.ref || !n3)
        return;
      const s3 = e3.option("parentEl") || i3.footer || i3.container;
      if (!s3)
        return;
      const o3 = u({}, e3.options, { parentEl: s3, classes: { container: "f-thumbs fancybox__thumbs" }, Carousel: { Sync: { friction: i3.option("Carousel.friction") || 0 } }, on: { ready: (t4) => {
        const i4 = t4.container;
        i4 && this.hidden && (e3.refresh(), i4.style.transition = "none", e3.hide(), i4.offsetHeight, queueMicrotask(() => {
          i4.style.transition = "", e3.show();
        }));
      } } });
      o3.Carousel = o3.Carousel || {}, o3.Carousel.on = u(((t3 = e3.options.Carousel) === null || t3 === void 0 ? void 0 : t3.on) || {}, { click: this.onClick, createSlide: this.onCreateSlide }), n3.options.Thumbs = o3, n3.attachPlugins({ Thumbs: _t }), e3.ref = n3.plugins.Thumbs, e3.option("showOnStart") || (e3.ref.state = Ft.Hidden, e3.hidden = true);
    }
    onResize() {
      var t3;
      const e3 = (t3 = this.ref) === null || t3 === void 0 ? void 0 : t3.container;
      e3 && (e3.style.maxHeight = "");
    }
    onKeydown(t3, e3) {
      const i3 = this.option("key");
      i3 && i3 === e3 && this.toggle();
    }
    toggle() {
      const t3 = this.ref;
      if (t3 && !t3.isDisabled())
        return t3.state === Ft.Hidden ? (t3.state = Ft.Init, void t3.build()) : void (this.hidden ? this.show() : this.hide());
    }
    show() {
      const t3 = this.ref;
      if (!t3 || t3.isDisabled())
        return;
      const e3 = t3.container;
      e3 && (this.refresh(), e3.offsetHeight, e3.removeAttribute(Xt), e3.classList.remove(Wt), this.hidden = false);
    }
    hide() {
      const t3 = this.ref, e3 = t3 && t3.container;
      e3 && (this.refresh(), e3.offsetHeight, e3.classList.add(Wt), e3.setAttribute(Xt, "true")), this.hidden = true;
    }
    refresh() {
      const t3 = this.ref;
      if (!t3 || !t3.state)
        return;
      const e3 = t3.container, i3 = (e3 == null ? void 0 : e3.firstChild) || null;
      e3 && i3 && i3.childNodes.length && (e3.style.maxHeight = `${i3.getBoundingClientRect().height}px`);
    }
    attach() {
      const t3 = this, e3 = t3.instance;
      e3.state === at.Init ? e3.on("Carousel.init", t3.onInit) : t3.onInit(), e3.on("resize", t3.onResize), e3.on("keydown", t3.onKeydown);
    }
    detach() {
      var t3;
      const e3 = this, i3 = e3.instance;
      i3.off("Carousel.init", e3.onInit), i3.off("resize", e3.onResize), i3.off("keydown", e3.onKeydown), (t3 = i3.carousel) === null || t3 === void 0 || t3.detachPlugins(["Thumbs"]), e3.ref = null;
    }
  };
  Object.defineProperty(qt, "defaults", { enumerable: true, configurable: true, writable: true, value: $t });
  var Yt = { panLeft: { icon: '<svg><path d="M5 12h14M5 12l6 6M5 12l6-6"/></svg>', change: { panX: -100 } }, panRight: { icon: '<svg><path d="M5 12h14M13 18l6-6M13 6l6 6"/></svg>', change: { panX: 100 } }, panUp: { icon: '<svg><path d="M12 5v14M18 11l-6-6M6 11l6-6"/></svg>', change: { panY: -100 } }, panDown: { icon: '<svg><path d="M12 5v14M18 13l-6 6M6 13l6 6"/></svg>', change: { panY: 100 } }, zoomIn: { icon: '<svg><circle cx="11" cy="11" r="7.5"/><path d="m21 21-4.35-4.35M11 8v6M8 11h6"/></svg>', action: "zoomIn" }, zoomOut: { icon: '<svg><circle cx="11" cy="11" r="7.5"/><path d="m21 21-4.35-4.35M8 11h6"/></svg>', action: "zoomOut" }, toggle1to1: { icon: '<svg><path d="M3.51 3.07c5.74.02 11.48-.02 17.22.02 1.37.1 2.34 1.64 2.18 3.13 0 4.08.02 8.16 0 12.23-.1 1.54-1.47 2.64-2.79 2.46-5.61-.01-11.24.02-16.86-.01-1.36-.12-2.33-1.65-2.17-3.14 0-4.07-.02-8.16 0-12.23.1-1.36 1.22-2.48 2.42-2.46Z"/><path d="M5.65 8.54h1.49v6.92m8.94-6.92h1.49v6.92M11.5 9.4v.02m0 5.18v0"/></svg>', action: "toggleZoom" }, toggleZoom: { icon: '<svg><g><line x1="11" y1="8" x2="11" y2="14"></line></g><circle cx="11" cy="11" r="7.5"/><path d="m21 21-4.35-4.35M8 11h6"/></svg>', action: "toggleZoom" }, iterateZoom: { icon: '<svg><g><line x1="11" y1="8" x2="11" y2="14"></line></g><circle cx="11" cy="11" r="7.5"/><path d="m21 21-4.35-4.35M8 11h6"/></svg>', action: "iterateZoom" }, rotateCCW: { icon: '<svg><path d="M15 4.55a8 8 0 0 0-6 14.9M9 15v5H4M18.37 7.16v.01M13 19.94v.01M16.84 18.37v.01M19.37 15.1v.01M19.94 11v.01"/></svg>', action: "rotateCCW" }, rotateCW: { icon: '<svg><path d="M9 4.55a8 8 0 0 1 6 14.9M15 15v5h5M5.63 7.16v.01M4.06 11v.01M4.63 15.1v.01M7.16 18.37v.01M11 19.94v.01"/></svg>', action: "rotateCW" }, flipX: { icon: '<svg style="stroke-width: 1.3"><path d="M12 3v18M16 7v10h5L16 7M8 7v10H3L8 7"/></svg>', action: "flipX" }, flipY: { icon: '<svg style="stroke-width: 1.3"><path d="M3 12h18M7 16h10L7 21v-5M7 8h10L7 3v5"/></svg>', action: "flipY" }, fitX: { icon: '<svg><path d="M4 12V6a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6M10 18H3M21 18h-7M6 15l-3 3 3 3M18 15l3 3-3 3"/></svg>', action: "fitX" }, fitY: { icon: '<svg><path d="M12 20H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h6M18 14v7M18 3v7M15 18l3 3 3-3M15 6l3-3 3 3"/></svg>', action: "fitY" }, reset: { icon: '<svg><path d="M20 11A8.1 8.1 0 0 0 4.5 9M4 5v4h4M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"/></svg>', action: "reset" }, toggleFS: { icon: '<svg><g><path d="M14.5 9.5 21 3m0 0h-6m6 0v6M3 21l6.5-6.5M3 21v-6m0 6h6"/></g><g><path d="m14 10 7-7m-7 7h6m-6 0V4M3 21l7-7m0 0v6m0-6H4"/></g></svg>', action: "toggleFS" } };
  var Vt;
  !function(t3) {
    t3[t3.Init = 0] = "Init", t3[t3.Ready = 1] = "Ready", t3[t3.Disabled = 2] = "Disabled";
  }(Vt || (Vt = {}));
  var Zt = { absolute: "auto", display: { left: ["infobar"], middle: [], right: ["iterateZoom", "slideshow", "fullscreen", "thumbs", "close"] }, enabled: "auto", items: { infobar: { tpl: '<div class="fancybox__infobar" tabindex="-1"><span data-fancybox-current-index></span>/<span data-fancybox-count></span></div>' }, download: { tpl: '<a class="f-button" title="{{DOWNLOAD}}" data-fancybox-download href="javasript:;"><svg><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M7 11l5 5 5-5M12 4v12"/></svg></a>' }, prev: { tpl: '<button class="f-button" title="{{PREV}}" data-fancybox-prev><svg><path d="m15 6-6 6 6 6"/></svg></button>' }, next: { tpl: '<button class="f-button" title="{{NEXT}}" data-fancybox-next><svg><path d="m9 6 6 6-6 6"/></svg></button>' }, slideshow: { tpl: '<button class="f-button" title="{{TOGGLE_SLIDESHOW}}" data-fancybox-toggle-slideshow><svg><g><path d="M8 4v16l13 -8z"></path></g><g><path d="M8 4v15M17 4v15"/></g></svg></button>' }, fullscreen: { tpl: '<button class="f-button" title="{{TOGGLE_FULLSCREEN}}" data-fancybox-toggle-fullscreen><svg><g><path d="M4 8V6a2 2 0 0 1 2-2h2M4 16v2a2 2 0 0 0 2 2h2M16 4h2a2 2 0 0 1 2 2v2M16 20h2a2 2 0 0 0 2-2v-2"/></g><g><path d="M15 19v-2a2 2 0 0 1 2-2h2M15 5v2a2 2 0 0 0 2 2h2M5 15h2a2 2 0 0 1 2 2v2M5 9h2a2 2 0 0 0 2-2V5"/></g></svg></button>' }, thumbs: { tpl: '<button class="f-button" title="{{TOGGLE_THUMBS}}" data-fancybox-toggle-thumbs><svg><circle cx="5.5" cy="5.5" r="1"/><circle cx="12" cy="5.5" r="1"/><circle cx="18.5" cy="5.5" r="1"/><circle cx="5.5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="18.5" cy="12" r="1"/><circle cx="5.5" cy="18.5" r="1"/><circle cx="12" cy="18.5" r="1"/><circle cx="18.5" cy="18.5" r="1"/></svg></button>' }, close: { tpl: '<button class="f-button" title="{{CLOSE}}" data-fancybox-close><svg><path d="m19.5 4.5-15 15M4.5 4.5l15 15"/></svg></button>' } }, parentEl: null };
  var Ut = { tabindex: "-1", width: "24", height: "24", viewBox: "0 0 24 24", xmlns: "http://www.w3.org/2000/svg" };
  var Gt = "has-toolbar";
  var Kt = "fancybox__toolbar";
  var Jt = class extends N {
    constructor() {
      super(...arguments), Object.defineProperty(this, "state", { enumerable: true, configurable: true, writable: true, value: Vt.Init }), Object.defineProperty(this, "container", { enumerable: true, configurable: true, writable: true, value: null });
    }
    onReady(t3) {
      var e3;
      if (!t3.carousel)
        return;
      let i3 = this.option("display"), n3 = this.option("absolute"), s3 = this.option("enabled");
      if (s3 === "auto") {
        const t4 = this.instance.carousel;
        let e4 = 0;
        if (t4)
          for (const i4 of t4.slides)
            (i4.panzoom || i4.type === "image") && e4++;
        e4 || (s3 = false);
      }
      s3 || (i3 = void 0);
      let o3 = 0;
      const a3 = { left: [], middle: [], right: [] };
      if (i3)
        for (const t4 of ["left", "middle", "right"])
          for (const n4 of i3[t4]) {
            const i4 = this.createEl(n4);
            i4 && ((e3 = a3[t4]) === null || e3 === void 0 || e3.push(i4), o3++);
          }
      let r3 = null;
      if (o3 && (r3 = this.createContainer()), r3) {
        for (const [t4, e4] of Object.entries(a3)) {
          const i4 = document.createElement("div");
          P(i4, Kt + "__column is-" + t4);
          for (const t5 of e4)
            i4.appendChild(t5);
          n3 !== "auto" || t4 !== "middle" || e4.length || (n3 = true), r3.appendChild(i4);
        }
        n3 === true && P(r3, "is-absolute"), this.state = Vt.Ready, this.onRefresh();
      } else
        this.state = Vt.Disabled;
    }
    onClick(t3) {
      var e3, i3;
      const n3 = this.instance, s3 = n3.getSlide(), o3 = s3 == null ? void 0 : s3.panzoom, a3 = t3.target, r3 = a3 && E(a3) ? a3.dataset : null;
      if (!r3)
        return;
      if (r3.fancyboxToggleThumbs !== void 0)
        return t3.preventDefault(), t3.stopPropagation(), void ((e3 = n3.plugins.Thumbs) === null || e3 === void 0 || e3.toggle());
      if (r3.fancyboxToggleFullscreen !== void 0)
        return t3.preventDefault(), t3.stopPropagation(), void this.instance.toggleFullscreen();
      if (r3.fancyboxToggleSlideshow !== void 0) {
        t3.preventDefault(), t3.stopPropagation();
        const e4 = (i3 = n3.carousel) === null || i3 === void 0 ? void 0 : i3.plugins.Autoplay;
        let s4 = e4.isActive;
        return o3 && o3.panMode === "mousemove" && !s4 && o3.reset(), void (s4 ? e4.stop() : e4.start());
      }
      const l3 = r3.panzoomAction, c3 = r3.panzoomChange;
      if ((c3 || l3) && (t3.preventDefault(), t3.stopPropagation()), c3) {
        let t4 = {};
        try {
          t4 = JSON.parse(c3);
        } catch (t5) {
        }
        o3 && o3.applyChange(t4);
      } else
        l3 && o3 && o3[l3] && o3[l3]();
    }
    onChange() {
      this.onRefresh();
    }
    onRefresh() {
      if (this.instance.isClosing())
        return;
      const t3 = this.container;
      if (!t3)
        return;
      const e3 = this.instance.getSlide();
      if (!e3 || e3.state !== rt.Ready)
        return;
      const i3 = e3 && !e3.error && e3.panzoom;
      for (const e4 of t3.querySelectorAll("[data-panzoom-action]"))
        i3 ? (e4.removeAttribute("disabled"), e4.removeAttribute("tabindex")) : (e4.setAttribute("disabled", ""), e4.setAttribute("tabindex", "-1"));
      let n3 = i3 && i3.canZoomIn(), s3 = i3 && i3.canZoomOut();
      for (const e4 of t3.querySelectorAll('[data-panzoom-action="zoomIn"]'))
        n3 ? (e4.removeAttribute("disabled"), e4.removeAttribute("tabindex")) : (e4.setAttribute("disabled", ""), e4.setAttribute("tabindex", "-1"));
      for (const e4 of t3.querySelectorAll('[data-panzoom-action="zoomOut"]'))
        s3 ? (e4.removeAttribute("disabled"), e4.removeAttribute("tabindex")) : (e4.setAttribute("disabled", ""), e4.setAttribute("tabindex", "-1"));
      for (const e4 of t3.querySelectorAll('[data-panzoom-action="toggleZoom"],[data-panzoom-action="iterateZoom"]')) {
        s3 || n3 ? (e4.removeAttribute("disabled"), e4.removeAttribute("tabindex")) : (e4.setAttribute("disabled", ""), e4.setAttribute("tabindex", "-1"));
        const t4 = e4.querySelector("g");
        t4 && (t4.style.display = n3 ? "" : "none");
      }
    }
    onDone(t3, e3) {
      var i3;
      (i3 = e3.panzoom) === null || i3 === void 0 || i3.on("afterTransform", () => {
        this.instance.isCurrentSlide(e3) && this.onRefresh();
      }), this.instance.isCurrentSlide(e3) && this.onRefresh();
    }
    createContainer() {
      const t3 = this.instance.container;
      if (!t3)
        return null;
      const e3 = this.option("parentEl") || t3;
      let i3 = e3.querySelector("." + Kt);
      return i3 || (i3 = document.createElement("div"), P(i3, Kt), e3.prepend(i3)), i3.addEventListener("click", this.onClick, { passive: false, capture: true }), t3 && P(t3, Gt), this.container = i3, i3;
    }
    createEl(t3) {
      const e3 = this.instance, i3 = e3.carousel;
      if (!i3)
        return null;
      if (t3 === "toggleFS")
        return null;
      if (t3 === "fullscreen" && !st())
        return null;
      let s3 = null;
      const o3 = i3.slides.length || 0;
      let a3 = 0, r3 = 0;
      for (const t4 of i3.slides)
        (t4.panzoom || t4.type === "image") && a3++, (t4.type === "image" || t4.downloadSrc) && r3++;
      if (o3 < 2 && ["infobar", "prev", "next"].includes(t3))
        return s3;
      if (Yt[t3] !== void 0 && !a3)
        return null;
      if (t3 === "download" && !r3)
        return null;
      if (t3 === "thumbs") {
        const t4 = e3.plugins.Thumbs;
        if (!t4 || !t4.isEnabled)
          return null;
      }
      if (t3 === "slideshow") {
        if (!i3.plugins.Autoplay || o3 < 2)
          return null;
      }
      if (Yt[t3] !== void 0) {
        const e4 = Yt[t3];
        s3 = document.createElement("button"), s3.setAttribute("title", this.instance.localize(`{{${t3.toUpperCase()}}}`)), P(s3, "f-button"), e4.action && (s3.dataset.panzoomAction = e4.action), e4.change && (s3.dataset.panzoomChange = JSON.stringify(e4.change)), s3.appendChild(n(this.instance.localize(e4.icon)));
      } else {
        const e4 = (this.option("items") || [])[t3];
        e4 && (s3 = n(this.instance.localize(e4.tpl)), typeof e4.click == "function" && s3.addEventListener("click", (t4) => {
          t4.preventDefault(), t4.stopPropagation(), typeof e4.click == "function" && e4.click.call(this, this, t4);
        }));
      }
      const l3 = s3 == null ? void 0 : s3.querySelector("svg");
      if (l3)
        for (const [t4, e4] of Object.entries(Ut))
          l3.getAttribute(t4) || l3.setAttribute(t4, String(e4));
      return s3;
    }
    removeContainer() {
      const t3 = this.container;
      t3 && t3.remove(), this.container = null, this.state = Vt.Disabled;
      const e3 = this.instance.container;
      e3 && S(e3, Gt);
    }
    attach() {
      const t3 = this, e3 = t3.instance;
      e3.on("Carousel.initSlides", t3.onReady), e3.on("done", t3.onDone), e3.on(["reveal", "Carousel.change"], t3.onChange), t3.onReady(t3.instance);
    }
    detach() {
      const t3 = this, e3 = t3.instance;
      e3.off("Carousel.initSlides", t3.onReady), e3.off("done", t3.onDone), e3.off(["reveal", "Carousel.change"], t3.onChange), t3.removeContainer();
    }
  };
  Object.defineProperty(Jt, "defaults", { enumerable: true, configurable: true, writable: true, value: Zt });
  var Qt = { Hash: class extends N {
    onReady() {
      ct = false;
    }
    onChange(t3) {
      dt && clearTimeout(dt);
      const { hash: e3 } = ut(), { hash: i3 } = pt(), n3 = t3.isOpeningSlide(t3.getSlide());
      n3 && (lt = i3 === e3 ? "" : i3), e3 && e3 !== i3 && (dt = setTimeout(() => {
        try {
          if (t3.state === at.Ready) {
            let t4 = "replaceState";
            n3 && !ht && (t4 = "pushState", ht = true), window.history[t4]({}, document.title, window.location.pathname + window.location.search + e3);
          }
        } catch (t4) {
        }
      }, 300));
    }
    onClose(t3) {
      if (dt && clearTimeout(dt), !ct && ht)
        return ht = false, ct = false, void window.history.back();
      if (!ct)
        try {
          window.history.replaceState({}, document.title, window.location.pathname + window.location.search + (lt || ""));
        } catch (t4) {
        }
    }
    attach() {
      const t3 = this.instance;
      t3.on("ready", this.onReady), t3.on(["Carousel.ready", "Carousel.change"], this.onChange), t3.on("close", this.onClose);
    }
    detach() {
      const t3 = this.instance;
      t3.off("ready", this.onReady), t3.off(["Carousel.ready", "Carousel.change"], this.onChange), t3.off("close", this.onClose);
    }
    static parseURL() {
      return pt();
    }
    static startFromUrl() {
      ft();
    }
    static destroy() {
      window.removeEventListener("hashchange", mt, false);
    }
  }, Html: At, Images: yt, Slideshow: It, Thumbs: qt, Toolbar: Jt };
  var te = "with-fancybox";
  var ee = "hide-scrollbar";
  var ie = "--fancybox-scrollbar-compensate";
  var ne = "--fancybox-body-margin";
  var se = "aria-hidden";
  var oe = "is-using-tab";
  var ae = "is-animated";
  var re = "is-compact";
  var le = "is-loading";
  var ce = "is-opening";
  var he = "has-caption";
  var de = "disabled";
  var ue = "tabindex";
  var pe = "download";
  var fe = "href";
  var ge = "src";
  var me = (t3) => typeof t3 == "string";
  var ve = function() {
    var t3 = window.getSelection();
    return !!t3 && t3.type === "Range";
  };
  var be;
  var ye = null;
  var we = null;
  var xe = 0;
  var Ee = 0;
  var Se = new Map();
  var Pe = 0;
  var Ce = class extends g {
    get isIdle() {
      return this.idle;
    }
    get isCompact() {
      return this.option("compact");
    }
    constructor(t3 = [], e3 = {}, i3 = {}) {
      super(e3), Object.defineProperty(this, "userSlides", { enumerable: true, configurable: true, writable: true, value: [] }), Object.defineProperty(this, "userPlugins", { enumerable: true, configurable: true, writable: true, value: {} }), Object.defineProperty(this, "idle", { enumerable: true, configurable: true, writable: true, value: false }), Object.defineProperty(this, "idleTimer", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "clickTimer", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "pwt", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "ignoreFocusChange", { enumerable: true, configurable: true, writable: true, value: false }), Object.defineProperty(this, "startedFs", { enumerable: true, configurable: true, writable: true, value: false }), Object.defineProperty(this, "state", { enumerable: true, configurable: true, writable: true, value: at.Init }), Object.defineProperty(this, "id", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "container", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "caption", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "footer", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "carousel", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "lastFocus", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "prevMouseMoveEvent", { enumerable: true, configurable: true, writable: true, value: void 0 }), be || (be = st()), this.id = e3.id || ++Pe, Se.set(this.id, this), this.userSlides = t3, this.userPlugins = i3, queueMicrotask(() => {
        this.init();
      });
    }
    init() {
      if (this.state === at.Destroy)
        return;
      this.state = at.Init, this.attachPlugins(Object.assign(Object.assign({}, Ce.Plugins), this.userPlugins)), this.emit("init"), this.emit("attachPlugins"), this.option("hideScrollbar") === true && (() => {
        if (!tt)
          return;
        const t4 = document, e3 = t4.body, i3 = t4.documentElement;
        if (e3.classList.contains(ee))
          return;
        let n3 = window.innerWidth - i3.getBoundingClientRect().width;
        const s3 = parseFloat(window.getComputedStyle(e3).marginRight);
        n3 < 0 && (n3 = 0), i3.style.setProperty(ie, `${n3}px`), s3 && e3.style.setProperty(ne, `${s3}px`), e3.classList.add(ee);
      })(), this.initLayout(), this.scale();
      const t3 = () => {
        this.initCarousel(this.userSlides), this.state = at.Ready, this.attachEvents(), this.emit("ready"), setTimeout(() => {
          this.container && this.container.setAttribute(se, "false");
        }, 16);
      };
      this.option("Fullscreen.autoStart") && be && !be.isFullscreen() ? be.request().then(() => {
        this.startedFs = true, t3();
      }).catch(() => t3()) : t3();
    }
    initLayout() {
      var t3, e3;
      const i3 = this.option("parentEl") || document.body, s3 = n(this.localize(this.option("tpl.main") || ""));
      s3 && (s3.setAttribute("id", `fancybox-${this.id}`), s3.setAttribute("aria-label", this.localize("{{MODAL}}")), s3.classList.toggle(re, this.isCompact), P(s3, this.option("mainClass") || ""), P(s3, ce), this.container = s3, this.footer = s3.querySelector(".fancybox__footer"), i3.appendChild(s3), P(document.documentElement, te), ye && we || (ye = document.createElement("span"), P(ye, "fancybox-focus-guard"), ye.setAttribute(ue, "0"), ye.setAttribute(se, "true"), ye.setAttribute("aria-label", "Focus guard"), we = ye.cloneNode(), (t3 = s3.parentElement) === null || t3 === void 0 || t3.insertBefore(ye, s3), (e3 = s3.parentElement) === null || e3 === void 0 || e3.append(we)), s3.addEventListener("mousedown", (t4) => {
        xe = t4.pageX, Ee = t4.pageY, S(s3, oe);
      }), this.option("animated") && (P(s3, ae), setTimeout(() => {
        this.isClosing() || S(s3, ae);
      }, 350)), this.emit("initLayout"));
    }
    initCarousel(t3) {
      const i3 = this.container;
      if (!i3)
        return;
      const n3 = i3.querySelector(".fancybox__carousel");
      if (!n3)
        return;
      const s3 = this.carousel = new J(n3, u({}, { slides: t3, transition: "fade", Panzoom: { lockAxis: this.option("dragToClose") ? "xy" : "x", infinite: !!this.option("dragToClose") && "y" }, Dots: false, Navigation: { classes: { container: "fancybox__nav", button: "f-button", isNext: "is-next", isPrev: "is-prev" } }, initialPage: this.option("startIndex"), l10n: this.option("l10n") }, this.option("Carousel") || {}));
      s3.on("*", (t4, e3, ...i4) => {
        this.emit(`Carousel.${e3}`, t4, ...i4);
      }), s3.on(["ready", "change"], () => {
        this.manageCaption();
      }), this.on("Carousel.removeSlide", (t4, e3, i4) => {
        this.clearContent(i4), i4.state = void 0;
      }), s3.on("Panzoom.touchStart", () => {
        var t4, e3;
        this.isCompact || this.endIdle(), ((t4 = document.activeElement) === null || t4 === void 0 ? void 0 : t4.closest(".f-thumbs")) && ((e3 = this.container) === null || e3 === void 0 || e3.focus());
      }), s3.on("settle", () => {
        this.idleTimer || this.isCompact || !this.option("idle") || this.setIdle(), this.option("autoFocus") && !this.isClosing && this.checkFocus();
      }), this.option("dragToClose") && (s3.on("Panzoom.afterTransform", (t4, i4) => {
        const n4 = this.getSlide();
        if (n4 && e(n4.el))
          return;
        const s4 = this.container;
        if (s4) {
          const t5 = Math.abs(i4.current.f), e3 = t5 < 1 ? "" : Math.max(0.5, Math.min(1, 1 - t5 / i4.contentRect.fitHeight * 1.5));
          s4.style.setProperty("--fancybox-ts", e3 ? "0s" : ""), s4.style.setProperty("--fancybox-opacity", e3 + "");
        }
      }), s3.on("Panzoom.touchEnd", (t4, i4, n4) => {
        var s4;
        const o3 = this.getSlide();
        if (o3 && e(o3.el))
          return;
        if (i4.isMobile && document.activeElement && ["TEXTAREA", "INPUT"].indexOf((s4 = document.activeElement) === null || s4 === void 0 ? void 0 : s4.nodeName) !== -1)
          return;
        const a3 = Math.abs(i4.dragOffset.y);
        i4.lockedAxis === "y" && (a3 >= 200 || a3 >= 50 && i4.dragOffset.time < 300) && (n4 && n4.cancelable && n4.preventDefault(), this.close(n4, "f-throwOut" + (i4.current.f < 0 ? "Up" : "Down")));
      })), s3.on("change", (t4) => {
        var e3;
        let i4 = (e3 = this.getSlide()) === null || e3 === void 0 ? void 0 : e3.triggerEl;
        if (i4) {
          const e4 = new CustomEvent("slideTo", { bubbles: true, cancelable: true, detail: t4.page });
          i4.dispatchEvent(e4);
        }
      }), s3.on(["refresh", "change"], (t4) => {
        const e3 = this.container;
        if (!e3)
          return;
        for (const i5 of e3.querySelectorAll("[data-fancybox-current-index]"))
          i5.innerHTML = t4.page + 1;
        for (const i5 of e3.querySelectorAll("[data-fancybox-count]"))
          i5.innerHTML = t4.pages.length;
        if (!t4.isInfinite) {
          for (const i5 of e3.querySelectorAll("[data-fancybox-next]"))
            t4.page < t4.pages.length - 1 ? (i5.removeAttribute(de), i5.removeAttribute(ue)) : (i5.setAttribute(de, ""), i5.setAttribute(ue, "-1"));
          for (const i5 of e3.querySelectorAll("[data-fancybox-prev]"))
            t4.page > 0 ? (i5.removeAttribute(de), i5.removeAttribute(ue)) : (i5.setAttribute(de, ""), i5.setAttribute(ue, "-1"));
        }
        const i4 = this.getSlide();
        if (!i4)
          return;
        let n4 = i4.downloadSrc || "";
        n4 || i4.type !== "image" || i4.error || !me(i4[ge]) || (n4 = i4[ge]);
        for (const t5 of e3.querySelectorAll("[data-fancybox-download]")) {
          const e4 = i4.downloadFilename;
          n4 ? (t5.removeAttribute(de), t5.removeAttribute(ue), t5.setAttribute(fe, n4), t5.setAttribute(pe, e4 || n4), t5.setAttribute("target", "_blank")) : (t5.setAttribute(de, ""), t5.setAttribute(ue, "-1"), t5.removeAttribute(fe), t5.removeAttribute(pe));
        }
      }), this.emit("initCarousel");
    }
    attachEvents() {
      const t3 = this, e3 = t3.container;
      if (!e3)
        return;
      e3.addEventListener("click", t3.onClick, { passive: false, capture: false }), e3.addEventListener("wheel", t3.onWheel, { passive: false, capture: false }), document.addEventListener("keydown", t3.onKeydown, { passive: false, capture: true }), document.addEventListener("visibilitychange", t3.onVisibilityChange, false), document.addEventListener("mousemove", t3.onMousemove), t3.option("trapFocus") && document.addEventListener("focus", t3.onFocus, true), window.addEventListener("resize", t3.onResize);
      const i3 = window.visualViewport;
      i3 && (i3.addEventListener("scroll", t3.onResize), i3.addEventListener("resize", t3.onResize));
    }
    detachEvents() {
      const t3 = this, e3 = t3.container;
      if (!e3)
        return;
      document.removeEventListener("keydown", t3.onKeydown, { passive: false, capture: true }), e3.removeEventListener("wheel", t3.onWheel, { passive: false, capture: false }), e3.removeEventListener("click", t3.onClick, { passive: false, capture: false }), document.removeEventListener("mousemove", t3.onMousemove), window.removeEventListener("resize", t3.onResize);
      const i3 = window.visualViewport;
      i3 && (i3.removeEventListener("resize", t3.onResize), i3.removeEventListener("scroll", t3.onResize)), document.removeEventListener("visibilitychange", t3.onVisibilityChange, false), document.removeEventListener("focus", t3.onFocus, true);
    }
    scale() {
      const t3 = this.container;
      if (!t3)
        return;
      const e3 = window.visualViewport, i3 = Math.max(1, (e3 == null ? void 0 : e3.scale) || 1);
      let n3 = "", s3 = "", o3 = "";
      if (e3 && i3 > 1) {
        let t4 = `${e3.offsetLeft}px`, a3 = `${e3.offsetTop}px`;
        n3 = e3.width * i3 + "px", s3 = e3.height * i3 + "px", o3 = `translate3d(${t4}, ${a3}, 0) scale(${1 / i3})`;
      }
      t3.style.transform = o3, t3.style.width = n3, t3.style.height = s3;
    }
    onClick(t3) {
      var e3;
      const { container: i3, isCompact: n3 } = this;
      if (!i3 || this.isClosing())
        return;
      !n3 && this.option("idle") && this.resetIdle();
      const s3 = t3.composedPath()[0];
      if (s3.closest(".fancybox-spinner") || s3.closest("[data-fancybox-close]"))
        return t3.preventDefault(), void this.close(t3);
      if (s3.closest("[data-fancybox-prev]"))
        return t3.preventDefault(), void this.prev();
      if (s3.closest("[data-fancybox-next]"))
        return t3.preventDefault(), void this.next();
      if (t3.type === "click" && t3.detail === 0)
        return;
      if (Math.abs(t3.pageX - xe) > 30 || Math.abs(t3.pageY - Ee) > 30)
        return;
      const o3 = document.activeElement;
      if (ve() && o3 && i3.contains(o3))
        return;
      if (n3 && ((e3 = this.getSlide()) === null || e3 === void 0 ? void 0 : e3.type) === "image")
        return void (this.clickTimer ? (clearTimeout(this.clickTimer), this.clickTimer = null) : this.clickTimer = setTimeout(() => {
          this.toggleIdle(), this.clickTimer = null;
        }, 350));
      if (this.emit("click", t3), t3.defaultPrevented)
        return;
      let a3 = false;
      if (s3.closest(".fancybox__content")) {
        if (o3) {
          if (o3.closest("[contenteditable]"))
            return;
          s3.matches(it) || o3.blur();
        }
        if (ve())
          return;
        a3 = this.option("contentClick");
      } else
        s3.closest(".fancybox__carousel") && !s3.matches(it) && (a3 = this.option("backdropClick"));
      a3 === "close" ? (t3.preventDefault(), this.close(t3)) : a3 === "next" ? (t3.preventDefault(), this.next()) : a3 === "prev" && (t3.preventDefault(), this.prev());
    }
    onWheel(t3) {
      const e3 = t3.target;
      let n3 = this.option("wheel", t3);
      e3.closest(".fancybox__thumbs") && (n3 = "slide");
      const s3 = n3 === "slide", o3 = [-t3.deltaX || 0, -t3.deltaY || 0, -t3.detail || 0].reduce(function(t4, e4) {
        return Math.abs(e4) > Math.abs(t4) ? e4 : t4;
      }), a3 = Math.max(-1, Math.min(1, o3)), r3 = Date.now();
      this.pwt && r3 - this.pwt < 300 ? s3 && t3.preventDefault() : (this.pwt = r3, this.emit("wheel", t3, a3), t3.defaultPrevented || (n3 === "close" ? (t3.preventDefault(), this.close(t3)) : n3 === "slide" && (i(e3) || (t3.preventDefault(), this[a3 > 0 ? "prev" : "next"]()))));
    }
    onKeydown(t3) {
      if (!this.isTopmost())
        return;
      this.isCompact || !this.option("idle") || this.isClosing() || this.resetIdle();
      const e3 = t3.key, i3 = this.option("keyboard");
      if (!i3)
        return;
      const n3 = t3.composedPath()[0], s3 = document.activeElement && document.activeElement.classList, o3 = s3 && s3.contains("f-button") || n3.dataset.carouselPage || n3.dataset.carouselIndex;
      if (e3 !== "Escape" && !o3 && E(n3)) {
        if (n3.isContentEditable || ["TEXTAREA", "OPTION", "INPUT", "SELECT", "VIDEO"].indexOf(n3.nodeName) !== -1)
          return;
      }
      if (t3.key === "Tab" ? P(this.container, oe) : S(this.container, oe), t3.ctrlKey || t3.altKey || t3.shiftKey)
        return;
      this.emit("keydown", e3, t3);
      const a3 = i3[e3];
      a3 && typeof this[a3] == "function" && (t3.preventDefault(), this[a3]());
    }
    onResize() {
      const t3 = this.container;
      if (!t3)
        return;
      const e3 = this.isCompact;
      t3.classList.toggle(re, e3), this.manageCaption(this.getSlide()), this.isCompact ? this.clearIdle() : this.endIdle(), this.scale(), this.emit("resize");
    }
    onFocus(t3) {
      this.isTopmost() && this.checkFocus(t3);
    }
    onMousemove(t3) {
      this.prevMouseMoveEvent = t3, !this.isCompact && this.option("idle") && this.resetIdle();
    }
    onVisibilityChange() {
      document.visibilityState === "visible" ? this.checkFocus() : this.endIdle();
    }
    manageCloseBtn(t3) {
      const e3 = this.optionFor(t3, "closeButton") || false;
      if (e3 === "auto") {
        const t4 = this.plugins.Toolbar;
        if (t4 && t4.state === Vt.Ready)
          return;
      }
      if (!e3)
        return;
      if (!t3.contentEl || t3.closeBtnEl)
        return;
      const i3 = this.option("tpl.closeButton");
      if (i3) {
        const e4 = n(this.localize(i3));
        t3.closeBtnEl = t3.contentEl.appendChild(e4), t3.el && P(t3.el, "has-close-btn");
      }
    }
    manageCaption(t3 = void 0) {
      var e3, i3;
      const n3 = "fancybox__caption", s3 = this.container;
      if (!s3)
        return;
      S(s3, he);
      const o3 = this.isCompact || this.option("commonCaption"), a3 = !o3;
      if (this.caption && this.stop(this.caption), a3 && this.caption && (this.caption.remove(), this.caption = null), o3 && !this.caption)
        for (const t4 of ((e3 = this.carousel) === null || e3 === void 0 ? void 0 : e3.slides) || [])
          t4.captionEl && (t4.captionEl.remove(), t4.captionEl = void 0, S(t4.el, he), (i3 = t4.el) === null || i3 === void 0 || i3.removeAttribute("aria-labelledby"));
      if (t3 || (t3 = this.getSlide()), !t3 || o3 && !this.isCurrentSlide(t3))
        return;
      const r3 = t3.el;
      let l3 = this.optionFor(t3, "caption", "");
      if (!l3)
        return void (o3 && this.caption && this.animate(this.caption, "f-fadeOut", () => {
          this.caption && (this.caption.innerHTML = "");
        }));
      let c3 = null;
      if (a3) {
        if (c3 = t3.captionEl || null, r3 && !c3) {
          const e4 = n3 + `_${this.id}_${t3.index}`;
          c3 = document.createElement("div"), P(c3, n3), c3.setAttribute("id", e4), t3.captionEl = r3.appendChild(c3), P(r3, he), r3.setAttribute("aria-labelledby", e4);
        }
      } else {
        if (c3 = this.caption, c3 || (c3 = s3.querySelector("." + n3)), !c3) {
          c3 = document.createElement("div"), c3.dataset.fancyboxCaption = "", P(c3, n3);
          (this.footer || s3).prepend(c3);
        }
        P(s3, he), this.caption = c3;
      }
      c3 && (c3.innerHTML = "", me(l3) || typeof l3 == "number" ? c3.innerHTML = l3 + "" : l3 instanceof HTMLElement && c3.appendChild(l3));
    }
    checkFocus(t3) {
      this.focus(t3);
    }
    focus(t3) {
      var e3;
      if (this.ignoreFocusChange)
        return;
      const i3 = document.activeElement || null, n3 = (t3 == null ? void 0 : t3.target) || null, s3 = this.container, o3 = (e3 = this.carousel) === null || e3 === void 0 ? void 0 : e3.viewport;
      if (!s3 || !o3)
        return;
      if (!t3 && i3 && s3.contains(i3))
        return;
      const a3 = this.getSlide(), r3 = a3 && a3.state === rt.Ready ? a3.el : null;
      if (!r3 || r3.contains(i3) || s3 === i3)
        return;
      t3 && t3.cancelable && t3.preventDefault(), this.ignoreFocusChange = true;
      const l3 = Array.from(s3.querySelectorAll(it));
      let c3 = [], h3 = null;
      for (let t4 of l3) {
        const e4 = !t4.offsetParent || !!t4.closest('[aria-hidden="true"]'), i4 = r3 && r3.contains(t4), n4 = !o3.contains(t4);
        if (t4 === s3 || (i4 || n4) && !e4) {
          c3.push(t4);
          const e5 = t4.dataset.origTabindex;
          e5 !== void 0 && e5 && (t4.tabIndex = parseFloat(e5)), t4.removeAttribute("data-orig-tabindex"), !t4.hasAttribute("autoFocus") && h3 || (h3 = t4);
        } else {
          const e5 = t4.dataset.origTabindex === void 0 ? t4.getAttribute("tabindex") || "" : t4.dataset.origTabindex;
          e5 && (t4.dataset.origTabindex = e5), t4.tabIndex = -1;
        }
      }
      let d3 = null;
      t3 ? (!n3 || c3.indexOf(n3) < 0) && (d3 = h3 || s3, c3.length && (i3 === we ? d3 = c3[0] : this.lastFocus !== s3 && i3 !== ye || (d3 = c3[c3.length - 1]))) : d3 = a3 && a3.type === "image" ? s3 : h3 || s3, d3 && nt(d3), this.lastFocus = document.activeElement, this.ignoreFocusChange = false;
    }
    next() {
      const t3 = this.carousel;
      t3 && t3.pages.length > 1 && t3.slideNext();
    }
    prev() {
      const t3 = this.carousel;
      t3 && t3.pages.length > 1 && t3.slidePrev();
    }
    jumpTo(...t3) {
      this.carousel && this.carousel.slideTo(...t3);
    }
    isTopmost() {
      var t3;
      return ((t3 = Ce.getInstance()) === null || t3 === void 0 ? void 0 : t3.id) == this.id;
    }
    animate(t3 = null, e3 = "", i3) {
      if (!t3 || !e3)
        return void (i3 && i3());
      this.stop(t3);
      const n3 = (s3) => {
        s3.target === t3 && t3.dataset.animationName && (t3.removeEventListener("animationend", n3), delete t3.dataset.animationName, i3 && i3(), S(t3, e3));
      };
      t3.dataset.animationName = e3, t3.addEventListener("animationend", n3), P(t3, e3);
    }
    stop(t3) {
      t3 && t3.dispatchEvent(new CustomEvent("animationend", { bubbles: false, cancelable: true, currentTarget: t3 }));
    }
    setContent(t3, e3 = "", i3 = true) {
      if (this.isClosing())
        return;
      const s3 = t3.el;
      if (!s3)
        return;
      let o3 = null;
      if (E(e3) ? o3 = e3 : (o3 = n(e3 + ""), E(o3) || (o3 = document.createElement("div"), o3.innerHTML = e3 + "")), ["img", "picture", "iframe", "video", "audio"].includes(o3.nodeName.toLowerCase())) {
        const t4 = document.createElement("div");
        t4.appendChild(o3), o3 = t4;
      }
      E(o3) && t3.filter && !t3.error && (o3 = o3.querySelector(t3.filter)), o3 && E(o3) ? (P(o3, "fancybox__content"), t3.id && o3.setAttribute("id", t3.id), o3.style.display !== "none" && getComputedStyle(o3).getPropertyValue("display") !== "none" || (o3.style.display = t3.display || this.option("defaultDisplay") || "flex"), s3.classList.add(`has-${t3.error ? "error" : t3.type || "unknown"}`), s3.prepend(o3), t3.contentEl = o3, i3 && this.revealContent(t3), this.manageCloseBtn(t3), this.manageCaption(t3)) : this.setError(t3, "{{ELEMENT_NOT_FOUND}}");
    }
    revealContent(t3, e3) {
      const i3 = t3.el, n3 = t3.contentEl;
      i3 && n3 && (this.emit("reveal", t3), this.hideLoading(t3), t3.state = rt.Opening, (e3 = this.isOpeningSlide(t3) ? e3 === void 0 ? this.optionFor(t3, "showClass") : e3 : "f-fadeIn") ? this.animate(n3, e3, () => {
        this.done(t3);
      }) : this.done(t3));
    }
    done(t3) {
      this.isClosing() || (t3.state = rt.Ready, this.emit("done", t3), P(t3.el, "is-done"), this.isCurrentSlide(t3) && this.option("autoFocus") && queueMicrotask(() => {
        var e3;
        (e3 = t3.panzoom) === null || e3 === void 0 || e3.updateControls(), this.option("autoFocus") && this.focus();
      }), this.isOpeningSlide(t3) && (S(this.container, ce), !this.isCompact && this.option("idle") && this.setIdle()));
    }
    isCurrentSlide(t3) {
      const e3 = this.getSlide();
      return !(!t3 || !e3) && e3.index === t3.index;
    }
    isOpeningSlide(t3) {
      var e3, i3;
      return ((e3 = this.carousel) === null || e3 === void 0 ? void 0 : e3.prevPage) === null && t3 && t3.index === ((i3 = this.getSlide()) === null || i3 === void 0 ? void 0 : i3.index);
    }
    showLoading(t3) {
      t3.state = rt.Loading;
      const e3 = t3.el;
      if (!e3)
        return;
      P(e3, le), this.emit("loading", t3), t3.spinnerEl || setTimeout(() => {
        if (!this.isClosing() && !t3.spinnerEl && t3.state === rt.Loading) {
          let i3 = n(x);
          P(i3, "fancybox-spinner"), t3.spinnerEl = i3, e3.prepend(i3), this.animate(i3, "f-fadeIn");
        }
      }, 250);
    }
    hideLoading(t3) {
      const e3 = t3.el;
      if (!e3)
        return;
      const i3 = t3.spinnerEl;
      this.isClosing() ? i3 == null || i3.remove() : (S(e3, le), i3 && this.animate(i3, "f-fadeOut", () => {
        i3.remove();
      }), t3.state === rt.Loading && (this.emit("loaded", t3), t3.state = rt.Ready));
    }
    setError(t3, e3) {
      if (this.isClosing())
        return;
      const i3 = new Event("error", { bubbles: true, cancelable: true });
      if (this.emit("error", i3, t3), i3.defaultPrevented)
        return;
      t3.error = e3, this.hideLoading(t3), this.clearContent(t3);
      const n3 = document.createElement("div");
      n3.classList.add("fancybox-error"), n3.innerHTML = this.localize(e3 || "<p>{{ERROR}}</p>"), this.setContent(t3, n3);
    }
    clearContent(t3) {
      if (t3.state === void 0)
        return;
      this.emit("clearContent", t3), t3.contentEl && (t3.contentEl.remove(), t3.contentEl = void 0);
      const e3 = t3.el;
      e3 && (S(e3, "has-error"), S(e3, "has-unknown"), S(e3, `has-${t3.type || "unknown"}`)), t3.closeBtnEl && t3.closeBtnEl.remove(), t3.closeBtnEl = void 0, t3.captionEl && t3.captionEl.remove(), t3.captionEl = void 0, t3.spinnerEl && t3.spinnerEl.remove(), t3.spinnerEl = void 0;
    }
    getSlide() {
      var t3;
      const e3 = this.carousel;
      return ((t3 = e3 == null ? void 0 : e3.pages[e3 == null ? void 0 : e3.page]) === null || t3 === void 0 ? void 0 : t3.slides[0]) || void 0;
    }
    close(t3, e3) {
      if (this.isClosing())
        return;
      const i3 = new Event("shouldClose", { bubbles: true, cancelable: true });
      if (this.emit("shouldClose", i3, t3), i3.defaultPrevented)
        return;
      t3 && t3.cancelable && (t3.preventDefault(), t3.stopPropagation());
      const n3 = () => {
        this.proceedClose(t3, e3);
      };
      this.startedFs && be && be.isFullscreen() ? Promise.resolve(be.exit()).then(() => n3()) : n3();
    }
    clearIdle() {
      this.idleTimer && clearTimeout(this.idleTimer), this.idleTimer = null;
    }
    setIdle(t3 = false) {
      const e3 = () => {
        this.clearIdle(), this.idle = true, P(this.container, "is-idle"), this.emit("setIdle");
      };
      if (this.clearIdle(), !this.isClosing())
        if (t3)
          e3();
        else {
          const t4 = this.option("idle");
          t4 && (this.idleTimer = setTimeout(e3, t4));
        }
    }
    endIdle() {
      this.clearIdle(), this.idle && !this.isClosing() && (this.idle = false, S(this.container, "is-idle"), this.emit("endIdle"));
    }
    resetIdle() {
      this.endIdle(), this.setIdle();
    }
    toggleIdle() {
      this.idle ? this.endIdle() : this.setIdle(true);
    }
    toggleFullscreen() {
      be && (be.isFullscreen() ? be.exit() : be.request().then(() => {
        this.startedFs = true;
      }));
    }
    isClosing() {
      return [at.Closing, at.CustomClosing, at.Destroy].includes(this.state);
    }
    proceedClose(t3, e3) {
      var i3, n3;
      this.state = at.Closing, this.clearIdle(), this.detachEvents();
      const s3 = this.container, o3 = this.carousel, a3 = this.getSlide(), r3 = a3 && this.option("placeFocusBack") ? a3.triggerEl || this.option("triggerEl") : null;
      if (r3 && (Q(r3) ? nt(r3) : r3.focus()), s3 && (S(s3, ce), P(s3, "is-closing"), s3.setAttribute(se, "true"), this.option("animated") && P(s3, ae), s3.style.pointerEvents = "none"), o3) {
        o3.clearTransitions(), (i3 = o3.panzoom) === null || i3 === void 0 || i3.destroy(), (n3 = o3.plugins.Navigation) === null || n3 === void 0 || n3.detach();
        for (const t4 of o3.slides) {
          t4.state = rt.Closing, this.hideLoading(t4);
          const e4 = t4.contentEl;
          e4 && this.stop(e4);
          const i4 = t4 == null ? void 0 : t4.panzoom;
          i4 && (i4.stop(), i4.detachEvents(), i4.detachObserver()), this.isCurrentSlide(t4) || o3.emit("removeSlide", t4);
        }
      }
      this.emit("close", t3), this.state !== at.CustomClosing ? (e3 === void 0 && a3 && (e3 = this.optionFor(a3, "hideClass")), e3 && a3 ? (this.animate(a3.contentEl, e3, () => {
        o3 && o3.emit("removeSlide", a3);
      }), setTimeout(() => {
        this.destroy();
      }, 500)) : this.destroy()) : setTimeout(() => {
        this.destroy();
      }, 500);
    }
    destroy() {
      var t3;
      if (this.state === at.Destroy)
        return;
      this.state = at.Destroy, (t3 = this.carousel) === null || t3 === void 0 || t3.destroy();
      const e3 = this.container;
      e3 && e3.remove(), Se.delete(this.id);
      const i3 = Ce.getInstance();
      i3 ? i3.focus() : (ye && (ye.remove(), ye = null), we && (we.remove(), we = null), S(document.documentElement, te), (() => {
        if (!tt)
          return;
        const t4 = document, e4 = t4.body;
        e4.classList.remove(ee), e4.style.setProperty(ne, ""), t4.documentElement.style.setProperty(ie, "");
      })(), this.emit("destroy"));
    }
    static bind(t3, e3, i3) {
      if (!tt)
        return;
      let n3, s3 = "", o3 = {};
      if (t3 === void 0 ? n3 = document.body : me(t3) ? (n3 = document.body, s3 = t3, typeof e3 == "object" && (o3 = e3 || {})) : (n3 = t3, me(e3) && (s3 = e3), typeof i3 == "object" && (o3 = i3 || {})), !n3 || !E(n3))
        return;
      s3 = s3 || "[data-fancybox]";
      const a3 = Ce.openers.get(n3) || new Map();
      a3.set(s3, o3), Ce.openers.set(n3, a3), a3.size === 1 && n3.addEventListener("click", Ce.fromEvent);
    }
    static unbind(t3, e3) {
      let i3, n3 = "";
      if (me(t3) ? (i3 = document.body, n3 = t3) : (i3 = t3, me(e3) && (n3 = e3)), !i3)
        return;
      const s3 = Ce.openers.get(i3);
      s3 && n3 && s3.delete(n3), n3 && s3 || (Ce.openers.delete(i3), i3.removeEventListener("click", Ce.fromEvent));
    }
    static destroy() {
      let t3;
      for (; t3 = Ce.getInstance(); )
        t3.destroy();
      for (const t4 of Ce.openers.keys())
        t4.removeEventListener("click", Ce.fromEvent);
      Ce.openers = new Map();
    }
    static fromEvent(t3) {
      if (t3.defaultPrevented)
        return;
      if (t3.button && t3.button !== 0)
        return;
      if (t3.ctrlKey || t3.metaKey || t3.shiftKey)
        return;
      let e3 = t3.composedPath()[0];
      const i3 = e3.closest("[data-fancybox-trigger]");
      if (i3) {
        const t4 = i3.dataset.fancyboxTrigger || "", n4 = document.querySelectorAll(`[data-fancybox="${t4}"]`), s4 = parseInt(i3.dataset.fancyboxIndex || "", 10) || 0;
        e3 = n4[s4] || e3;
      }
      if (!(e3 && e3 instanceof Element))
        return;
      let n3, s3, o3, a3;
      if ([...Ce.openers].reverse().find(([t4, i4]) => !(!t4.contains(e3) || ![...i4].reverse().find(([i5, r4]) => {
        let l4 = e3.closest(i5);
        return !!l4 && (n3 = t4, s3 = i5, o3 = l4, a3 = r4, true);
      }))), !n3 || !s3 || !o3)
        return;
      a3 = a3 || {}, t3.preventDefault(), e3 = o3;
      let r3 = [], l3 = u({}, ot, a3);
      l3.event = t3, l3.triggerEl = e3, l3.delegate = i3;
      const c3 = l3.groupAll, h3 = l3.groupAttr, d3 = h3 && e3 ? e3.getAttribute(`${h3}`) : "";
      if ((!e3 || d3 || c3) && (r3 = [].slice.call(n3.querySelectorAll(s3))), e3 && !c3 && (r3 = d3 ? r3.filter((t4) => t4.getAttribute(`${h3}`) === d3) : [e3]), !r3.length)
        return;
      const p3 = Ce.getInstance();
      return p3 && p3.options.triggerEl && r3.indexOf(p3.options.triggerEl) > -1 ? void 0 : (e3 && (l3.startIndex = r3.indexOf(e3)), Ce.fromNodes(r3, l3));
    }
    static fromSelector(t3, e3, i3) {
      let n3 = null, s3 = "", o3 = {};
      if (me(t3) ? (n3 = document.body, s3 = t3, typeof e3 == "object" && (o3 = e3 || {})) : t3 instanceof HTMLElement && me(e3) && (n3 = t3, s3 = e3, typeof i3 == "object" && (o3 = i3 || {})), !n3 || !s3)
        return false;
      const a3 = Ce.openers.get(n3);
      return !!a3 && (o3 = u({}, a3.get(s3) || {}, o3), !!o3 && Ce.fromNodes(Array.from(n3.querySelectorAll(s3)), o3));
    }
    static fromNodes(t3, e3) {
      e3 = u({}, ot, e3 || {});
      const i3 = [];
      for (const n3 of t3) {
        const t4 = n3.dataset || {}, s3 = t4[ge] || n3.getAttribute(fe) || n3.getAttribute("currentSrc") || n3.getAttribute(ge) || void 0;
        let o3;
        const a3 = e3.delegate;
        let r3;
        a3 && i3.length === e3.startIndex && (o3 = a3 instanceof HTMLImageElement ? a3 : a3.querySelector("img:not([aria-hidden])")), o3 || (o3 = n3 instanceof HTMLImageElement ? n3 : n3.querySelector("img:not([aria-hidden])")), o3 && (r3 = o3.currentSrc || o3[ge] || void 0, !r3 && o3.dataset && (r3 = o3.dataset.lazySrc || o3.dataset[ge] || void 0));
        const l3 = { src: s3, triggerEl: n3, thumbEl: o3, thumbElSrc: r3, thumbSrc: r3 };
        for (const e4 in t4) {
          let i4 = t4[e4] + "";
          i4 = i4 !== "false" && (i4 === "true" || i4), l3[e4] = i4;
        }
        i3.push(l3);
      }
      return new Ce(i3, e3);
    }
    static getInstance(t3) {
      if (t3)
        return Se.get(t3);
      return Array.from(Se.values()).reverse().find((t4) => !t4.isClosing() && t4) || null;
    }
    static getSlide() {
      var t3;
      return ((t3 = Ce.getInstance()) === null || t3 === void 0 ? void 0 : t3.getSlide()) || null;
    }
    static show(t3 = [], e3 = {}) {
      return new Ce(t3, e3);
    }
    static next() {
      const t3 = Ce.getInstance();
      t3 && t3.next();
    }
    static prev() {
      const t3 = Ce.getInstance();
      t3 && t3.prev();
    }
    static close(t3 = true, ...e3) {
      if (t3)
        for (const t4 of Se.values())
          t4.close(...e3);
      else {
        const t4 = Ce.getInstance();
        t4 && t4.close(...e3);
      }
    }
  };
  Object.defineProperty(Ce, "version", { enumerable: true, configurable: true, writable: true, value: "5.0.33" }), Object.defineProperty(Ce, "defaults", { enumerable: true, configurable: true, writable: true, value: ot }), Object.defineProperty(Ce, "Plugins", { enumerable: true, configurable: true, writable: true, value: Qt }), Object.defineProperty(Ce, "openers", { enumerable: true, configurable: true, writable: true, value: new Map() });

  // node_modules/@fancyapps/ui/dist/carousel/carousel.thumbs.esm.js
  var t2 = (e3, ...i3) => {
    const s3 = i3.length;
    for (let n3 = 0; n3 < s3; n3++) {
      const s4 = i3[n3] || {};
      Object.entries(s4).forEach(([i4, s5]) => {
        const n4 = Array.isArray(s5) ? [] : {};
        var r3;
        e3[i4] || Object.assign(e3, { [i4]: n4 }), typeof (r3 = s5) == "object" && r3 !== null && r3.constructor === Object && Object.prototype.toString.call(r3) === "[object Object]" ? Object.assign(e3[i4], t2(n4, s5)) : Array.isArray(s5) ? Object.assign(e3, { [i4]: [...s5] }) : Object.assign(e3, { [i4]: s5 });
      });
    }
    return e3;
  };
  var e2 = (t3) => `${t3 || ""}`.split(" ").filter((t4) => !!t4);
  var i2 = (t3, i3) => {
    t3 && e2(i3).forEach((e3) => {
      t3.classList.add(e3);
    });
  };
  var s2 = (t3, i3) => {
    t3 && e2(i3).forEach((e3) => {
      t3.classList.remove(e3);
    });
  };
  var n2 = function(t3, e3) {
    return t3.split(".").reduce((t4, e4) => typeof t4 == "object" ? t4[e4] : void 0, e3);
  };
  var r2 = class {
    constructor(t3 = {}) {
      Object.defineProperty(this, "options", { enumerable: true, configurable: true, writable: true, value: t3 }), Object.defineProperty(this, "events", { enumerable: true, configurable: true, writable: true, value: new Map() }), this.setOptions(t3);
      for (const t4 of Object.getOwnPropertyNames(Object.getPrototypeOf(this)))
        t4.startsWith("on") && typeof this[t4] == "function" && (this[t4] = this[t4].bind(this));
    }
    setOptions(e3) {
      this.options = e3 ? t2({}, this.constructor.defaults, e3) : {};
      for (const [t3, e4] of Object.entries(this.option("on") || {}))
        this.on(t3, e4);
    }
    option(t3, ...e3) {
      let i3 = n2(t3, this.options);
      return i3 && typeof i3 == "function" && (i3 = i3.call(this, this, ...e3)), i3;
    }
    optionFor(t3, e3, i3, ...s3) {
      let r3 = n2(e3, t3);
      var o3;
      typeof (o3 = r3) != "string" || isNaN(o3) || isNaN(parseFloat(o3)) || (r3 = parseFloat(r3)), r3 === "true" && (r3 = true), r3 === "false" && (r3 = false), r3 && typeof r3 == "function" && (r3 = r3.call(this, this, t3, ...s3));
      let a3 = n2(e3, this.options);
      return a3 && typeof a3 == "function" ? r3 = a3.call(this, this, t3, ...s3, r3) : r3 === void 0 && (r3 = a3), r3 === void 0 ? i3 : r3;
    }
    cn(t3) {
      const e3 = this.options.classes;
      return e3 && e3[t3] || "";
    }
    localize(t3, e3 = []) {
      t3 = String(t3).replace(/\{\{(\w+).?(\w+)?\}\}/g, (t4, e4, i3) => {
        let s3 = "";
        return i3 ? s3 = this.option(`${e4[0] + e4.toLowerCase().substring(1)}.l10n.${i3}`) : e4 && (s3 = this.option(`l10n.${e4}`)), s3 || (s3 = t4), s3;
      });
      for (let i3 = 0; i3 < e3.length; i3++)
        t3 = t3.split(e3[i3][0]).join(e3[i3][1]);
      return t3 = t3.replace(/\{\{(.*?)\}\}/g, (t4, e4) => e4);
    }
    on(t3, e3) {
      let i3 = [];
      typeof t3 == "string" ? i3 = t3.split(" ") : Array.isArray(t3) && (i3 = t3), this.events || (this.events = new Map()), i3.forEach((t4) => {
        let i4 = this.events.get(t4);
        i4 || (this.events.set(t4, []), i4 = []), i4.includes(e3) || i4.push(e3), this.events.set(t4, i4);
      });
    }
    off(t3, e3) {
      let i3 = [];
      typeof t3 == "string" ? i3 = t3.split(" ") : Array.isArray(t3) && (i3 = t3), i3.forEach((t4) => {
        const i4 = this.events.get(t4);
        if (Array.isArray(i4)) {
          const t5 = i4.indexOf(e3);
          t5 > -1 && i4.splice(t5, 1);
        }
      });
    }
    emit(t3, ...e3) {
      [...this.events.get(t3) || []].forEach((t4) => t4(this, ...e3)), t3 !== "*" && this.emit("*", t3, ...e3);
    }
  };
  Object.defineProperty(r2, "version", { enumerable: true, configurable: true, writable: true, value: "5.0.33" }), Object.defineProperty(r2, "defaults", { enumerable: true, configurable: true, writable: true, value: {} });
  var o2 = class extends r2 {
    constructor(t3, e3) {
      super(e3), Object.defineProperty(this, "instance", { enumerable: true, configurable: true, writable: true, value: t3 });
    }
    attach() {
    }
    detach() {
    }
  };
  var a2;
  var l2;
  !function(t3) {
    t3[t3.Init = 0] = "Init", t3[t3.Error = 1] = "Error", t3[t3.Ready = 2] = "Ready", t3[t3.Panning = 3] = "Panning", t3[t3.Mousemove = 4] = "Mousemove", t3[t3.Destroy = 5] = "Destroy";
  }(a2 || (a2 = {})), function(t3) {
    t3[t3.Init = 0] = "Init", t3[t3.Ready = 1] = "Ready", t3[t3.Destroy = 2] = "Destroy";
  }(l2 || (l2 = {}));
  var c2 = (t3, e3 = 1e4) => (t3 = parseFloat(t3 + "") || 0, Math.round((t3 + Number.EPSILON) * e3) / e3);
  var h2 = { classes: { container: "f-thumbs f-carousel__thumbs", viewport: "f-thumbs__viewport", track: "f-thumbs__track", slide: "f-thumbs__slide", isResting: "is-resting", isSelected: "is-selected", isLoading: "is-loading", hasThumbs: "has-thumbs" }, minCount: 2, parentEl: null, thumbTpl: '<button class="f-thumbs__slide__button" tabindex="0" type="button" aria-label="{{GOTO}}" data-carousel-index="%i"><img class="f-thumbs__slide__img" data-lazy-src="{{%s}}" alt="" /></button>', type: "modern" };
  var u2;
  !function(t3) {
    t3[t3.Init = 0] = "Init", t3[t3.Ready = 1] = "Ready", t3[t3.Hidden = 2] = "Hidden";
  }(u2 || (u2 = {}));
  var d2 = "isResting";
  var f2 = "thumbWidth";
  var b2 = "thumbHeight";
  var p2 = "thumbClipWidth";
  var g2 = class extends o2 {
    constructor() {
      super(...arguments), Object.defineProperty(this, "type", { enumerable: true, configurable: true, writable: true, value: "modern" }), Object.defineProperty(this, "container", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "track", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "carousel", { enumerable: true, configurable: true, writable: true, value: null }), Object.defineProperty(this, "thumbWidth", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "thumbClipWidth", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "thumbHeight", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "thumbGap", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "thumbExtraGap", { enumerable: true, configurable: true, writable: true, value: 0 }), Object.defineProperty(this, "state", { enumerable: true, configurable: true, writable: true, value: u2.Init });
    }
    get isModern() {
      return this.type === "modern";
    }
    onInitSlide(t3, e3) {
      const i3 = e3.el ? e3.el.dataset : void 0;
      i3 && (e3.thumbSrc = i3.thumbSrc || e3.thumbSrc || "", e3[p2] = parseFloat(i3[p2] || "") || e3[p2] || 0, e3[b2] = parseFloat(i3.thumbHeight || "") || e3[b2] || 0), this.addSlide(e3);
    }
    onInitSlides() {
      this.build();
    }
    onChange() {
      var t3;
      if (!this.isModern)
        return;
      const i3 = this.container, n3 = this.instance, r3 = n3.panzoom, o3 = this.carousel, a3 = o3 ? o3.panzoom : null, l3 = n3.page;
      if (r3 && o3 && a3) {
        if (r3.isDragging) {
          s2(i3, this.cn(d2));
          let e3 = ((t3 = o3.pages[l3]) === null || t3 === void 0 ? void 0 : t3.pos) || 0;
          e3 += n3.getProgress(l3) * (this[p2] + this.thumbGap);
          let r4 = a3.getBounds();
          -1 * e3 > r4.x.min && -1 * e3 < r4.x.max && a3.panTo({ x: -1 * e3, friction: 0.12 });
        } else
          c3 = i3, h3 = this.cn(d2), u3 = r3.isResting, c3 && e2(h3).forEach((t4) => {
            c3.classList.toggle(t4, u3 || false);
          });
        var c3, h3, u3;
        this.shiftModern();
      }
    }
    onRefresh() {
      this.updateProps();
      for (const t3 of this.instance.slides || [])
        this.resizeModernSlide(t3);
      this.shiftModern();
    }
    isDisabled() {
      const t3 = this.option("minCount") || 0;
      if (t3) {
        const e4 = this.instance;
        let i3 = 0;
        for (const t4 of e4.slides || [])
          t4.thumbSrc && i3++;
        if (i3 < t3)
          return true;
      }
      const e3 = this.option("type");
      return ["modern", "classic"].indexOf(e3) < 0;
    }
    getThumb(t3) {
      const e3 = this.option("thumbTpl") || "";
      return { html: this.instance.localize(e3, [["%i", t3.index], ["%d", t3.index + 1], ["%s", t3.thumbSrc || "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"]]) };
    }
    addSlide(t3) {
      const e3 = this.carousel;
      e3 && e3.addSlide(t3.index, this.getThumb(t3));
    }
    getSlides() {
      const t3 = [];
      for (const e3 of this.instance.slides || [])
        t3.push(this.getThumb(e3));
      return t3;
    }
    resizeModernSlide(t3) {
      this.isModern && (t3[f2] = t3[p2] && t3[b2] ? Math.round(this[b2] * (t3[p2] / t3[b2])) : this[f2]);
    }
    updateProps() {
      const t3 = this.container;
      if (!t3)
        return;
      const e3 = (e4) => parseFloat(getComputedStyle(t3).getPropertyValue("--f-thumb-" + e4)) || 0;
      this.thumbGap = e3("gap"), this.thumbExtraGap = e3("extra-gap"), this[f2] = e3("width") || 40, this[p2] = e3("clip-width") || 40, this[b2] = e3("height") || 40;
    }
    build() {
      const e3 = this;
      if (e3.state !== u2.Init)
        return;
      if (e3.isDisabled())
        return void e3.emit("disabled");
      const s3 = e3.instance, n3 = s3.container, r3 = e3.getSlides(), o3 = e3.option("type");
      e3.type = o3;
      const a3 = e3.option("parentEl"), l3 = e3.cn("container"), c3 = e3.cn("track");
      let h3 = a3 == null ? void 0 : a3.querySelector("." + l3);
      h3 || (h3 = document.createElement("div"), i2(h3, l3), a3 ? a3.appendChild(h3) : n3.after(h3)), i2(h3, `is-${o3}`), i2(n3, e3.cn("hasThumbs")), e3.container = h3, e3.updateProps();
      let d3 = h3.querySelector("." + c3);
      d3 || (d3 = document.createElement("div"), i2(d3, e3.cn("track")), h3.appendChild(d3)), e3.track = d3;
      const f3 = t2({}, { track: d3, infinite: false, center: true, fill: o3 === "classic", dragFree: true, slidesPerPage: 1, transition: false, preload: 0.25, friction: 0.12, Panzoom: { maxVelocity: 0 }, Dots: false, Navigation: false, classes: { container: "f-thumbs", viewport: "f-thumbs__viewport", track: "f-thumbs__track", slide: "f-thumbs__slide" } }, e3.option("Carousel") || {}, { Sync: { target: s3 }, slides: r3 }), b3 = new s3.constructor(h3, f3);
      b3.on("createSlide", (t3, i3) => {
        e3.setProps(i3.index), e3.emit("createSlide", i3, i3.el);
      }), b3.on("ready", () => {
        e3.shiftModern(), e3.emit("ready");
      }), b3.on("refresh", () => {
        e3.shiftModern();
      }), b3.on("Panzoom.click", (t3, i3, s4) => {
        e3.onClick(s4);
      }), e3.carousel = b3, e3.state = u2.Ready;
    }
    onClick(t3) {
      t3.preventDefault(), t3.stopPropagation();
      const e3 = this.instance, { pages: i3, page: s3 } = e3, n3 = (t4) => {
        if (t4) {
          const e4 = t4.closest("[data-carousel-index]");
          if (e4)
            return [parseInt(e4.dataset.carouselIndex || "", 10) || 0, e4];
        }
        return [-1, void 0];
      }, r3 = (t4, e4) => {
        const i4 = document.elementFromPoint(t4, e4);
        return i4 ? n3(i4) : [-1, void 0];
      };
      let [o3, a3] = n3(t3.target);
      if (o3 > -1)
        return;
      const l3 = this[p2], c3 = t3.clientX, h3 = t3.clientY;
      let [u3, d3] = r3(c3 - l3, h3), [f3, b3] = r3(c3 + l3, h3);
      d3 && b3 ? (o3 = Math.abs(c3 - d3.getBoundingClientRect().right) < Math.abs(c3 - b3.getBoundingClientRect().left) ? u3 : f3, o3 === s3 && (o3 = o3 === u3 ? f3 : u3)) : d3 ? o3 = u3 : b3 && (o3 = f3), o3 > -1 && i3[o3] && e3.slideTo(o3);
    }
    getShift(t3) {
      var e3;
      const i3 = this, { instance: s3 } = i3, n3 = i3.carousel;
      if (!s3 || !n3)
        return 0;
      const r3 = i3[f2], o3 = i3[p2], a3 = i3.thumbGap, l3 = i3.thumbExtraGap;
      if (!((e3 = n3.slides[t3]) === null || e3 === void 0 ? void 0 : e3.el))
        return 0;
      const c3 = 0.5 * (r3 - o3), h3 = s3.pages.length - 1;
      let u3 = s3.getProgress(0), d3 = s3.getProgress(h3), b3 = s3.getProgress(t3, false, true), g3 = 0, m2 = c3 + l3 + a3;
      const y2 = u3 < 0 && u3 > -1, v2 = d3 > 0 && d3 < 1;
      return t3 === 0 ? (g3 = m2 * Math.abs(u3), v2 && u3 === 1 && (g3 -= m2 * Math.abs(d3))) : t3 === h3 ? (g3 = m2 * Math.abs(d3) * -1, y2 && d3 === -1 && (g3 += m2 * Math.abs(u3))) : y2 || v2 ? (g3 = -1 * m2, g3 += m2 * Math.abs(u3), g3 += m2 * (1 - Math.abs(d3))) : g3 = m2 * b3, g3;
    }
    setProps(t3) {
      var e3;
      const i3 = this;
      if (!i3.isModern)
        return;
      const { instance: s3 } = i3, n3 = i3.carousel;
      if (s3 && n3) {
        const r3 = (e3 = n3.slides[t3]) === null || e3 === void 0 ? void 0 : e3.el;
        if (r3 && r3.childNodes.length) {
          let e4 = c2(1 - Math.abs(s3.getProgress(t3))), n4 = c2(i3.getShift(t3));
          r3.style.setProperty("--progress", e4 ? e4 + "" : ""), r3.style.setProperty("--shift", n4 + "");
        }
      }
    }
    shiftModern() {
      const t3 = this;
      if (!t3.isModern)
        return;
      const { instance: e3, track: i3 } = t3, s3 = e3.panzoom, n3 = t3.carousel;
      if (!(e3 && i3 && s3 && n3))
        return;
      if (s3.state === a2.Init || s3.state === a2.Destroy)
        return;
      for (const i4 of e3.slides)
        t3.setProps(i4.index);
      let r3 = (t3[p2] + t3.thumbGap) * (n3.slides.length || 0);
      i3.style.setProperty("--width", r3 + "");
    }
    cleanup() {
      const t3 = this;
      t3.carousel && t3.carousel.destroy(), t3.carousel = null, t3.container && t3.container.remove(), t3.container = null, t3.track && t3.track.remove(), t3.track = null, t3.state = u2.Init, s2(t3.instance.container, t3.cn("hasThumbs"));
    }
    attach() {
      const t3 = this, e3 = t3.instance;
      e3.on("initSlide", t3.onInitSlide), e3.state === l2.Init ? e3.on("initSlides", t3.onInitSlides) : t3.onInitSlides(), e3.on(["change", "Panzoom.afterTransform"], t3.onChange), e3.on("Panzoom.refresh", t3.onRefresh);
    }
    detach() {
      const t3 = this, e3 = t3.instance;
      e3.off("initSlide", t3.onInitSlide), e3.off("initSlides", t3.onInitSlides), e3.off(["change", "Panzoom.afterTransform"], t3.onChange), e3.off("Panzoom.refresh", t3.onRefresh), t3.cleanup();
    }
  };
  Object.defineProperty(g2, "defaults", { enumerable: true, configurable: true, writable: true, value: h2 });

  // resources/js/fancybox.js
  var productCarousel = new J(document.getElementById("galleryCarousel"), {
    transition: "slide",
    preload: 3,
    Dots: false,
    Thumbs: {
      type: "classic",
      Carousel: {
        dragFree: false,
        slidesPerPage: "auto",
        Navigation: true,
        axis: "x"
      }
    }
  }, { Thumbs: g2 });
  Ce.bind('[data-fancybox="gallery"]', {
    compact: false,
    idle: false,
    dragToClose: false,
    contentClick: () => window.matchMedia("(max-width: 578px), (max-height: 578px)").matches ? "toggleMax" : "toggleCover",
    animated: false,
    showClass: false,
    hideClass: false,
    Hash: false,
    Thumbs: {
      type: "classic"
    },
    Toolbar: {
      display: {
        left: [],
        middle: [],
        right: ["close"]
      }
    },
    Carousel: {
      transition: "fadeFast",
      preload: 3
    },
    Images: {
      zoom: false,
      Panzoom: {
        panMode: "mousemove",
        mouseMoveFactor: 1.1
      }
    }
  });
})();
