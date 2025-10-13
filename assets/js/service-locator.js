(() => {
  // node_modules/fast-equals/dist/esm/index.mjs
  var getOwnPropertyNames = Object.getOwnPropertyNames;
  var getOwnPropertySymbols = Object.getOwnPropertySymbols;
  var hasOwnProperty = Object.prototype.hasOwnProperty;
  function combineComparators(comparatorA, comparatorB) {
    return function isEqual(a, b, state) {
      return comparatorA(a, b, state) && comparatorB(a, b, state);
    };
  }
  function createIsCircular(areItemsEqual) {
    return function isCircular(a, b, state) {
      if (!a || !b || typeof a !== "object" || typeof b !== "object") {
        return areItemsEqual(a, b, state);
      }
      var cache = state.cache;
      var cachedA = cache.get(a);
      var cachedB = cache.get(b);
      if (cachedA && cachedB) {
        return cachedA === b && cachedB === a;
      }
      cache.set(a, b);
      cache.set(b, a);
      var result = areItemsEqual(a, b, state);
      cache.delete(a);
      cache.delete(b);
      return result;
    };
  }
  function getShortTag(value) {
    return value != null ? value[Symbol.toStringTag] : void 0;
  }
  function getStrictProperties(object) {
    return getOwnPropertyNames(object).concat(getOwnPropertySymbols(object));
  }
  var hasOwn = Object.hasOwn || function(object, property) {
    return hasOwnProperty.call(object, property);
  };
  function sameValueZeroEqual(a, b) {
    return a === b || !a && !b && a !== a && b !== b;
  }
  var PREACT_VNODE = "__v";
  var PREACT_OWNER = "__o";
  var REACT_OWNER = "_owner";
  var getOwnPropertyDescriptor = Object.getOwnPropertyDescriptor;
  var keys = Object.keys;
  function areArraysEqual(a, b, state) {
    var index = a.length;
    if (b.length !== index) {
      return false;
    }
    while (index-- > 0) {
      if (!state.equals(a[index], b[index], index, index, a, b, state)) {
        return false;
      }
    }
    return true;
  }
  function areDatesEqual(a, b) {
    return sameValueZeroEqual(a.getTime(), b.getTime());
  }
  function areErrorsEqual(a, b) {
    return a.name === b.name && a.message === b.message && a.cause === b.cause && a.stack === b.stack;
  }
  function areFunctionsEqual(a, b) {
    return a === b;
  }
  function areMapsEqual(a, b, state) {
    var size = a.size;
    if (size !== b.size) {
      return false;
    }
    if (!size) {
      return true;
    }
    var matchedIndices = new Array(size);
    var aIterable = a.entries();
    var aResult;
    var bResult;
    var index = 0;
    while (aResult = aIterable.next()) {
      if (aResult.done) {
        break;
      }
      var bIterable = b.entries();
      var hasMatch = false;
      var matchIndex = 0;
      while (bResult = bIterable.next()) {
        if (bResult.done) {
          break;
        }
        if (matchedIndices[matchIndex]) {
          matchIndex++;
          continue;
        }
        var aEntry = aResult.value;
        var bEntry = bResult.value;
        if (state.equals(aEntry[0], bEntry[0], index, matchIndex, a, b, state) && state.equals(aEntry[1], bEntry[1], aEntry[0], bEntry[0], a, b, state)) {
          hasMatch = matchedIndices[matchIndex] = true;
          break;
        }
        matchIndex++;
      }
      if (!hasMatch) {
        return false;
      }
      index++;
    }
    return true;
  }
  var areNumbersEqual = sameValueZeroEqual;
  function areObjectsEqual(a, b, state) {
    var properties = keys(a);
    var index = properties.length;
    if (keys(b).length !== index) {
      return false;
    }
    while (index-- > 0) {
      if (!isPropertyEqual(a, b, state, properties[index])) {
        return false;
      }
    }
    return true;
  }
  function areObjectsEqualStrict(a, b, state) {
    var properties = getStrictProperties(a);
    var index = properties.length;
    if (getStrictProperties(b).length !== index) {
      return false;
    }
    var property;
    var descriptorA;
    var descriptorB;
    while (index-- > 0) {
      property = properties[index];
      if (!isPropertyEqual(a, b, state, property)) {
        return false;
      }
      descriptorA = getOwnPropertyDescriptor(a, property);
      descriptorB = getOwnPropertyDescriptor(b, property);
      if ((descriptorA || descriptorB) && (!descriptorA || !descriptorB || descriptorA.configurable !== descriptorB.configurable || descriptorA.enumerable !== descriptorB.enumerable || descriptorA.writable !== descriptorB.writable)) {
        return false;
      }
    }
    return true;
  }
  function arePrimitiveWrappersEqual(a, b) {
    return sameValueZeroEqual(a.valueOf(), b.valueOf());
  }
  function areRegExpsEqual(a, b) {
    return a.source === b.source && a.flags === b.flags;
  }
  function areSetsEqual(a, b, state) {
    var size = a.size;
    if (size !== b.size) {
      return false;
    }
    if (!size) {
      return true;
    }
    var matchedIndices = new Array(size);
    var aIterable = a.values();
    var aResult;
    var bResult;
    while (aResult = aIterable.next()) {
      if (aResult.done) {
        break;
      }
      var bIterable = b.values();
      var hasMatch = false;
      var matchIndex = 0;
      while (bResult = bIterable.next()) {
        if (bResult.done) {
          break;
        }
        if (!matchedIndices[matchIndex] && state.equals(aResult.value, bResult.value, aResult.value, bResult.value, a, b, state)) {
          hasMatch = matchedIndices[matchIndex] = true;
          break;
        }
        matchIndex++;
      }
      if (!hasMatch) {
        return false;
      }
    }
    return true;
  }
  function areTypedArraysEqual(a, b) {
    var index = a.length;
    if (b.length !== index) {
      return false;
    }
    while (index-- > 0) {
      if (a[index] !== b[index]) {
        return false;
      }
    }
    return true;
  }
  function areUrlsEqual(a, b) {
    return a.hostname === b.hostname && a.pathname === b.pathname && a.protocol === b.protocol && a.port === b.port && a.hash === b.hash && a.username === b.username && a.password === b.password;
  }
  function isPropertyEqual(a, b, state, property) {
    if ((property === REACT_OWNER || property === PREACT_OWNER || property === PREACT_VNODE) && (a.$$typeof || b.$$typeof)) {
      return true;
    }
    return hasOwn(b, property) && state.equals(a[property], b[property], property, property, a, b, state);
  }
  var ARGUMENTS_TAG = "[object Arguments]";
  var BOOLEAN_TAG = "[object Boolean]";
  var DATE_TAG = "[object Date]";
  var ERROR_TAG = "[object Error]";
  var MAP_TAG = "[object Map]";
  var NUMBER_TAG = "[object Number]";
  var OBJECT_TAG = "[object Object]";
  var REG_EXP_TAG = "[object RegExp]";
  var SET_TAG = "[object Set]";
  var STRING_TAG = "[object String]";
  var URL_TAG = "[object URL]";
  var isArray = Array.isArray;
  var isTypedArray = typeof ArrayBuffer === "function" && ArrayBuffer.isView ? ArrayBuffer.isView : null;
  var assign = Object.assign;
  var getTag = Object.prototype.toString.call.bind(Object.prototype.toString);
  function createEqualityComparator(_a) {
    var areArraysEqual2 = _a.areArraysEqual, areDatesEqual2 = _a.areDatesEqual, areErrorsEqual2 = _a.areErrorsEqual, areFunctionsEqual2 = _a.areFunctionsEqual, areMapsEqual2 = _a.areMapsEqual, areNumbersEqual2 = _a.areNumbersEqual, areObjectsEqual2 = _a.areObjectsEqual, arePrimitiveWrappersEqual2 = _a.arePrimitiveWrappersEqual, areRegExpsEqual2 = _a.areRegExpsEqual, areSetsEqual2 = _a.areSetsEqual, areTypedArraysEqual2 = _a.areTypedArraysEqual, areUrlsEqual2 = _a.areUrlsEqual, unknownTagComparators = _a.unknownTagComparators;
    return function comparator(a, b, state) {
      if (a === b) {
        return true;
      }
      if (a == null || b == null) {
        return false;
      }
      var type = typeof a;
      if (type !== typeof b) {
        return false;
      }
      if (type !== "object") {
        if (type === "number") {
          return areNumbersEqual2(a, b, state);
        }
        if (type === "function") {
          return areFunctionsEqual2(a, b, state);
        }
        return false;
      }
      var constructor = a.constructor;
      if (constructor !== b.constructor) {
        return false;
      }
      if (constructor === Object) {
        return areObjectsEqual2(a, b, state);
      }
      if (isArray(a)) {
        return areArraysEqual2(a, b, state);
      }
      if (isTypedArray != null && isTypedArray(a)) {
        return areTypedArraysEqual2(a, b, state);
      }
      if (constructor === Date) {
        return areDatesEqual2(a, b, state);
      }
      if (constructor === RegExp) {
        return areRegExpsEqual2(a, b, state);
      }
      if (constructor === Map) {
        return areMapsEqual2(a, b, state);
      }
      if (constructor === Set) {
        return areSetsEqual2(a, b, state);
      }
      var tag = getTag(a);
      if (tag === DATE_TAG) {
        return areDatesEqual2(a, b, state);
      }
      if (tag === REG_EXP_TAG) {
        return areRegExpsEqual2(a, b, state);
      }
      if (tag === MAP_TAG) {
        return areMapsEqual2(a, b, state);
      }
      if (tag === SET_TAG) {
        return areSetsEqual2(a, b, state);
      }
      if (tag === OBJECT_TAG) {
        return typeof a.then !== "function" && typeof b.then !== "function" && areObjectsEqual2(a, b, state);
      }
      if (tag === URL_TAG) {
        return areUrlsEqual2(a, b, state);
      }
      if (tag === ERROR_TAG) {
        return areErrorsEqual2(a, b, state);
      }
      if (tag === ARGUMENTS_TAG) {
        return areObjectsEqual2(a, b, state);
      }
      if (tag === BOOLEAN_TAG || tag === NUMBER_TAG || tag === STRING_TAG) {
        return arePrimitiveWrappersEqual2(a, b, state);
      }
      if (unknownTagComparators) {
        var unknownTagComparator = unknownTagComparators[tag];
        if (!unknownTagComparator) {
          var shortTag = getShortTag(a);
          if (shortTag) {
            unknownTagComparator = unknownTagComparators[shortTag];
          }
        }
        if (unknownTagComparator) {
          return unknownTagComparator(a, b, state);
        }
      }
      return false;
    };
  }
  function createEqualityComparatorConfig(_a) {
    var circular = _a.circular, createCustomConfig = _a.createCustomConfig, strict = _a.strict;
    var config = {
      areArraysEqual: strict ? areObjectsEqualStrict : areArraysEqual,
      areDatesEqual,
      areErrorsEqual,
      areFunctionsEqual,
      areMapsEqual: strict ? combineComparators(areMapsEqual, areObjectsEqualStrict) : areMapsEqual,
      areNumbersEqual,
      areObjectsEqual: strict ? areObjectsEqualStrict : areObjectsEqual,
      arePrimitiveWrappersEqual,
      areRegExpsEqual,
      areSetsEqual: strict ? combineComparators(areSetsEqual, areObjectsEqualStrict) : areSetsEqual,
      areTypedArraysEqual: strict ? areObjectsEqualStrict : areTypedArraysEqual,
      areUrlsEqual,
      unknownTagComparators: void 0
    };
    if (createCustomConfig) {
      config = assign({}, config, createCustomConfig(config));
    }
    if (circular) {
      var areArraysEqual$1 = createIsCircular(config.areArraysEqual);
      var areMapsEqual$1 = createIsCircular(config.areMapsEqual);
      var areObjectsEqual$1 = createIsCircular(config.areObjectsEqual);
      var areSetsEqual$1 = createIsCircular(config.areSetsEqual);
      config = assign({}, config, {
        areArraysEqual: areArraysEqual$1,
        areMapsEqual: areMapsEqual$1,
        areObjectsEqual: areObjectsEqual$1,
        areSetsEqual: areSetsEqual$1
      });
    }
    return config;
  }
  function createInternalEqualityComparator(compare) {
    return function(a, b, _indexOrKeyA, _indexOrKeyB, _parentA, _parentB, state) {
      return compare(a, b, state);
    };
  }
  function createIsEqual(_a) {
    var circular = _a.circular, comparator = _a.comparator, createState = _a.createState, equals = _a.equals, strict = _a.strict;
    if (createState) {
      return function isEqual(a, b) {
        var _a2 = createState(), _b = _a2.cache, cache = _b === void 0 ? circular ? new WeakMap() : void 0 : _b, meta = _a2.meta;
        return comparator(a, b, {
          cache,
          equals,
          meta,
          strict
        });
      };
    }
    if (circular) {
      return function isEqual(a, b) {
        return comparator(a, b, {
          cache: new WeakMap(),
          equals,
          meta: void 0,
          strict
        });
      };
    }
    var state = {
      cache: void 0,
      equals,
      meta: void 0,
      strict
    };
    return function isEqual(a, b) {
      return comparator(a, b, state);
    };
  }
  var deepEqual = createCustomEqual();
  var strictDeepEqual = createCustomEqual({ strict: true });
  var circularDeepEqual = createCustomEqual({ circular: true });
  var strictCircularDeepEqual = createCustomEqual({
    circular: true,
    strict: true
  });
  var shallowEqual = createCustomEqual({
    createInternalComparator: function() {
      return sameValueZeroEqual;
    }
  });
  var strictShallowEqual = createCustomEqual({
    strict: true,
    createInternalComparator: function() {
      return sameValueZeroEqual;
    }
  });
  var circularShallowEqual = createCustomEqual({
    circular: true,
    createInternalComparator: function() {
      return sameValueZeroEqual;
    }
  });
  var strictCircularShallowEqual = createCustomEqual({
    circular: true,
    createInternalComparator: function() {
      return sameValueZeroEqual;
    },
    strict: true
  });
  function createCustomEqual(options) {
    if (options === void 0) {
      options = {};
    }
    var _a = options.circular, circular = _a === void 0 ? false : _a, createCustomInternalComparator = options.createInternalComparator, createState = options.createState, _b = options.strict, strict = _b === void 0 ? false : _b;
    var config = createEqualityComparatorConfig(options);
    var comparator = createEqualityComparator(config);
    var equals = createCustomInternalComparator ? createCustomInternalComparator(comparator) : createInternalEqualityComparator(comparator);
    return createIsEqual({ circular, comparator, createState, equals, strict });
  }

  // node_modules/kdbush/index.js
  var ARRAY_TYPES = [
    Int8Array,
    Uint8Array,
    Uint8ClampedArray,
    Int16Array,
    Uint16Array,
    Int32Array,
    Uint32Array,
    Float32Array,
    Float64Array
  ];
  var VERSION = 1;
  var HEADER_SIZE = 8;
  var KDBush = class {
    static from(data) {
      if (!(data instanceof ArrayBuffer)) {
        throw new Error("Data must be an instance of ArrayBuffer.");
      }
      const [magic, versionAndType] = new Uint8Array(data, 0, 2);
      if (magic !== 219) {
        throw new Error("Data does not appear to be in a KDBush format.");
      }
      const version = versionAndType >> 4;
      if (version !== VERSION) {
        throw new Error(`Got v${version} data when expected v${VERSION}.`);
      }
      const ArrayType = ARRAY_TYPES[versionAndType & 15];
      if (!ArrayType) {
        throw new Error("Unrecognized array type.");
      }
      const [nodeSize] = new Uint16Array(data, 2, 1);
      const [numItems] = new Uint32Array(data, 4, 1);
      return new KDBush(numItems, nodeSize, ArrayType, data);
    }
    constructor(numItems, nodeSize = 64, ArrayType = Float64Array, data) {
      if (isNaN(numItems) || numItems < 0)
        throw new Error(`Unpexpected numItems value: ${numItems}.`);
      this.numItems = +numItems;
      this.nodeSize = Math.min(Math.max(+nodeSize, 2), 65535);
      this.ArrayType = ArrayType;
      this.IndexArrayType = numItems < 65536 ? Uint16Array : Uint32Array;
      const arrayTypeIndex = ARRAY_TYPES.indexOf(this.ArrayType);
      const coordsByteSize = numItems * 2 * this.ArrayType.BYTES_PER_ELEMENT;
      const idsByteSize = numItems * this.IndexArrayType.BYTES_PER_ELEMENT;
      const padCoords = (8 - idsByteSize % 8) % 8;
      if (arrayTypeIndex < 0) {
        throw new Error(`Unexpected typed array class: ${ArrayType}.`);
      }
      if (data && data instanceof ArrayBuffer) {
        this.data = data;
        this.ids = new this.IndexArrayType(this.data, HEADER_SIZE, numItems);
        this.coords = new this.ArrayType(this.data, HEADER_SIZE + idsByteSize + padCoords, numItems * 2);
        this._pos = numItems * 2;
        this._finished = true;
      } else {
        this.data = new ArrayBuffer(HEADER_SIZE + coordsByteSize + idsByteSize + padCoords);
        this.ids = new this.IndexArrayType(this.data, HEADER_SIZE, numItems);
        this.coords = new this.ArrayType(this.data, HEADER_SIZE + idsByteSize + padCoords, numItems * 2);
        this._pos = 0;
        this._finished = false;
        new Uint8Array(this.data, 0, 2).set([219, (VERSION << 4) + arrayTypeIndex]);
        new Uint16Array(this.data, 2, 1)[0] = nodeSize;
        new Uint32Array(this.data, 4, 1)[0] = numItems;
      }
    }
    add(x, y) {
      const index = this._pos >> 1;
      this.ids[index] = index;
      this.coords[this._pos++] = x;
      this.coords[this._pos++] = y;
      return index;
    }
    finish() {
      const numAdded = this._pos >> 1;
      if (numAdded !== this.numItems) {
        throw new Error(`Added ${numAdded} items when expected ${this.numItems}.`);
      }
      sort(this.ids, this.coords, this.nodeSize, 0, this.numItems - 1, 0);
      this._finished = true;
      return this;
    }
    range(minX, minY, maxX, maxY) {
      if (!this._finished)
        throw new Error("Data not yet indexed - call index.finish().");
      const { ids, coords, nodeSize } = this;
      const stack = [0, ids.length - 1, 0];
      const result = [];
      while (stack.length) {
        const axis = stack.pop() || 0;
        const right = stack.pop() || 0;
        const left = stack.pop() || 0;
        if (right - left <= nodeSize) {
          for (let i = left; i <= right; i++) {
            const x2 = coords[2 * i];
            const y2 = coords[2 * i + 1];
            if (x2 >= minX && x2 <= maxX && y2 >= minY && y2 <= maxY)
              result.push(ids[i]);
          }
          continue;
        }
        const m = left + right >> 1;
        const x = coords[2 * m];
        const y = coords[2 * m + 1];
        if (x >= minX && x <= maxX && y >= minY && y <= maxY)
          result.push(ids[m]);
        if (axis === 0 ? minX <= x : minY <= y) {
          stack.push(left);
          stack.push(m - 1);
          stack.push(1 - axis);
        }
        if (axis === 0 ? maxX >= x : maxY >= y) {
          stack.push(m + 1);
          stack.push(right);
          stack.push(1 - axis);
        }
      }
      return result;
    }
    within(qx, qy, r) {
      if (!this._finished)
        throw new Error("Data not yet indexed - call index.finish().");
      const { ids, coords, nodeSize } = this;
      const stack = [0, ids.length - 1, 0];
      const result = [];
      const r2 = r * r;
      while (stack.length) {
        const axis = stack.pop() || 0;
        const right = stack.pop() || 0;
        const left = stack.pop() || 0;
        if (right - left <= nodeSize) {
          for (let i = left; i <= right; i++) {
            if (sqDist(coords[2 * i], coords[2 * i + 1], qx, qy) <= r2)
              result.push(ids[i]);
          }
          continue;
        }
        const m = left + right >> 1;
        const x = coords[2 * m];
        const y = coords[2 * m + 1];
        if (sqDist(x, y, qx, qy) <= r2)
          result.push(ids[m]);
        if (axis === 0 ? qx - r <= x : qy - r <= y) {
          stack.push(left);
          stack.push(m - 1);
          stack.push(1 - axis);
        }
        if (axis === 0 ? qx + r >= x : qy + r >= y) {
          stack.push(m + 1);
          stack.push(right);
          stack.push(1 - axis);
        }
      }
      return result;
    }
  };
  function sort(ids, coords, nodeSize, left, right, axis) {
    if (right - left <= nodeSize)
      return;
    const m = left + right >> 1;
    select(ids, coords, m, left, right, axis);
    sort(ids, coords, nodeSize, left, m - 1, 1 - axis);
    sort(ids, coords, nodeSize, m + 1, right, 1 - axis);
  }
  function select(ids, coords, k, left, right, axis) {
    while (right > left) {
      if (right - left > 600) {
        const n = right - left + 1;
        const m = k - left + 1;
        const z = Math.log(n);
        const s = 0.5 * Math.exp(2 * z / 3);
        const sd = 0.5 * Math.sqrt(z * s * (n - s) / n) * (m - n / 2 < 0 ? -1 : 1);
        const newLeft = Math.max(left, Math.floor(k - m * s / n + sd));
        const newRight = Math.min(right, Math.floor(k + (n - m) * s / n + sd));
        select(ids, coords, k, newLeft, newRight, axis);
      }
      const t = coords[2 * k + axis];
      let i = left;
      let j = right;
      swapItem(ids, coords, left, k);
      if (coords[2 * right + axis] > t)
        swapItem(ids, coords, left, right);
      while (i < j) {
        swapItem(ids, coords, i, j);
        i++;
        j--;
        while (coords[2 * i + axis] < t)
          i++;
        while (coords[2 * j + axis] > t)
          j--;
      }
      if (coords[2 * left + axis] === t)
        swapItem(ids, coords, left, j);
      else {
        j++;
        swapItem(ids, coords, j, right);
      }
      if (j <= k)
        left = j + 1;
      if (k <= j)
        right = j - 1;
    }
  }
  function swapItem(ids, coords, i, j) {
    swap(ids, i, j);
    swap(coords, 2 * i, 2 * j);
    swap(coords, 2 * i + 1, 2 * j + 1);
  }
  function swap(arr, i, j) {
    const tmp = arr[i];
    arr[i] = arr[j];
    arr[j] = tmp;
  }
  function sqDist(ax, ay, bx, by) {
    const dx = ax - bx;
    const dy = ay - by;
    return dx * dx + dy * dy;
  }

  // node_modules/supercluster/index.js
  var defaultOptions = {
    minZoom: 0,
    maxZoom: 16,
    minPoints: 2,
    radius: 40,
    extent: 512,
    nodeSize: 64,
    log: false,
    generateId: false,
    reduce: null,
    map: (props) => props
  };
  var fround = Math.fround || ((tmp) => (x) => {
    tmp[0] = +x;
    return tmp[0];
  })(new Float32Array(1));
  var OFFSET_ZOOM = 2;
  var OFFSET_ID = 3;
  var OFFSET_PARENT = 4;
  var OFFSET_NUM = 5;
  var OFFSET_PROP = 6;
  var Supercluster = class {
    constructor(options) {
      this.options = Object.assign(Object.create(defaultOptions), options);
      this.trees = new Array(this.options.maxZoom + 1);
      this.stride = this.options.reduce ? 7 : 6;
      this.clusterProps = [];
    }
    load(points) {
      const { log, minZoom, maxZoom } = this.options;
      if (log)
        console.time("total time");
      const timerId = `prepare ${points.length} points`;
      if (log)
        console.time(timerId);
      this.points = points;
      const data = [];
      for (let i = 0; i < points.length; i++) {
        const p = points[i];
        if (!p.geometry)
          continue;
        const [lng, lat] = p.geometry.coordinates;
        const x = fround(lngX(lng));
        const y = fround(latY(lat));
        data.push(x, y, Infinity, i, -1, 1);
        if (this.options.reduce)
          data.push(0);
      }
      let tree = this.trees[maxZoom + 1] = this._createTree(data);
      if (log)
        console.timeEnd(timerId);
      for (let z = maxZoom; z >= minZoom; z--) {
        const now = +Date.now();
        tree = this.trees[z] = this._createTree(this._cluster(tree, z));
        if (log)
          console.log("z%d: %d clusters in %dms", z, tree.numItems, +Date.now() - now);
      }
      if (log)
        console.timeEnd("total time");
      return this;
    }
    getClusters(bbox, zoom) {
      let minLng = ((bbox[0] + 180) % 360 + 360) % 360 - 180;
      const minLat = Math.max(-90, Math.min(90, bbox[1]));
      let maxLng = bbox[2] === 180 ? 180 : ((bbox[2] + 180) % 360 + 360) % 360 - 180;
      const maxLat = Math.max(-90, Math.min(90, bbox[3]));
      if (bbox[2] - bbox[0] >= 360) {
        minLng = -180;
        maxLng = 180;
      } else if (minLng > maxLng) {
        const easternHem = this.getClusters([minLng, minLat, 180, maxLat], zoom);
        const westernHem = this.getClusters([-180, minLat, maxLng, maxLat], zoom);
        return easternHem.concat(westernHem);
      }
      const tree = this.trees[this._limitZoom(zoom)];
      const ids = tree.range(lngX(minLng), latY(maxLat), lngX(maxLng), latY(minLat));
      const data = tree.data;
      const clusters = [];
      for (const id of ids) {
        const k = this.stride * id;
        clusters.push(data[k + OFFSET_NUM] > 1 ? getClusterJSON(data, k, this.clusterProps) : this.points[data[k + OFFSET_ID]]);
      }
      return clusters;
    }
    getChildren(clusterId) {
      const originId = this._getOriginId(clusterId);
      const originZoom = this._getOriginZoom(clusterId);
      const errorMsg = "No cluster with the specified id.";
      const tree = this.trees[originZoom];
      if (!tree)
        throw new Error(errorMsg);
      const data = tree.data;
      if (originId * this.stride >= data.length)
        throw new Error(errorMsg);
      const r = this.options.radius / (this.options.extent * Math.pow(2, originZoom - 1));
      const x = data[originId * this.stride];
      const y = data[originId * this.stride + 1];
      const ids = tree.within(x, y, r);
      const children = [];
      for (const id of ids) {
        const k = id * this.stride;
        if (data[k + OFFSET_PARENT] === clusterId) {
          children.push(data[k + OFFSET_NUM] > 1 ? getClusterJSON(data, k, this.clusterProps) : this.points[data[k + OFFSET_ID]]);
        }
      }
      if (children.length === 0)
        throw new Error(errorMsg);
      return children;
    }
    getLeaves(clusterId, limit, offset) {
      limit = limit || 10;
      offset = offset || 0;
      const leaves = [];
      this._appendLeaves(leaves, clusterId, limit, offset, 0);
      return leaves;
    }
    getTile(z, x, y) {
      const tree = this.trees[this._limitZoom(z)];
      const z2 = Math.pow(2, z);
      const { extent, radius } = this.options;
      const p = radius / extent;
      const top = (y - p) / z2;
      const bottom = (y + 1 + p) / z2;
      const tile = {
        features: []
      };
      this._addTileFeatures(tree.range((x - p) / z2, top, (x + 1 + p) / z2, bottom), tree.data, x, y, z2, tile);
      if (x === 0) {
        this._addTileFeatures(tree.range(1 - p / z2, top, 1, bottom), tree.data, z2, y, z2, tile);
      }
      if (x === z2 - 1) {
        this._addTileFeatures(tree.range(0, top, p / z2, bottom), tree.data, -1, y, z2, tile);
      }
      return tile.features.length ? tile : null;
    }
    getClusterExpansionZoom(clusterId) {
      let expansionZoom = this._getOriginZoom(clusterId) - 1;
      while (expansionZoom <= this.options.maxZoom) {
        const children = this.getChildren(clusterId);
        expansionZoom++;
        if (children.length !== 1)
          break;
        clusterId = children[0].properties.cluster_id;
      }
      return expansionZoom;
    }
    _appendLeaves(result, clusterId, limit, offset, skipped) {
      const children = this.getChildren(clusterId);
      for (const child of children) {
        const props = child.properties;
        if (props && props.cluster) {
          if (skipped + props.point_count <= offset) {
            skipped += props.point_count;
          } else {
            skipped = this._appendLeaves(result, props.cluster_id, limit, offset, skipped);
          }
        } else if (skipped < offset) {
          skipped++;
        } else {
          result.push(child);
        }
        if (result.length === limit)
          break;
      }
      return skipped;
    }
    _createTree(data) {
      const tree = new KDBush(data.length / this.stride | 0, this.options.nodeSize, Float32Array);
      for (let i = 0; i < data.length; i += this.stride)
        tree.add(data[i], data[i + 1]);
      tree.finish();
      tree.data = data;
      return tree;
    }
    _addTileFeatures(ids, data, x, y, z2, tile) {
      for (const i of ids) {
        const k = i * this.stride;
        const isCluster = data[k + OFFSET_NUM] > 1;
        let tags, px, py;
        if (isCluster) {
          tags = getClusterProperties(data, k, this.clusterProps);
          px = data[k];
          py = data[k + 1];
        } else {
          const p = this.points[data[k + OFFSET_ID]];
          tags = p.properties;
          const [lng, lat] = p.geometry.coordinates;
          px = lngX(lng);
          py = latY(lat);
        }
        const f = {
          type: 1,
          geometry: [[
            Math.round(this.options.extent * (px * z2 - x)),
            Math.round(this.options.extent * (py * z2 - y))
          ]],
          tags
        };
        let id;
        if (isCluster || this.options.generateId) {
          id = data[k + OFFSET_ID];
        } else {
          id = this.points[data[k + OFFSET_ID]].id;
        }
        if (id !== void 0)
          f.id = id;
        tile.features.push(f);
      }
    }
    _limitZoom(z) {
      return Math.max(this.options.minZoom, Math.min(Math.floor(+z), this.options.maxZoom + 1));
    }
    _cluster(tree, zoom) {
      const { radius, extent, reduce, minPoints } = this.options;
      const r = radius / (extent * Math.pow(2, zoom));
      const data = tree.data;
      const nextData = [];
      const stride = this.stride;
      for (let i = 0; i < data.length; i += stride) {
        if (data[i + OFFSET_ZOOM] <= zoom)
          continue;
        data[i + OFFSET_ZOOM] = zoom;
        const x = data[i];
        const y = data[i + 1];
        const neighborIds = tree.within(data[i], data[i + 1], r);
        const numPointsOrigin = data[i + OFFSET_NUM];
        let numPoints = numPointsOrigin;
        for (const neighborId of neighborIds) {
          const k = neighborId * stride;
          if (data[k + OFFSET_ZOOM] > zoom)
            numPoints += data[k + OFFSET_NUM];
        }
        if (numPoints > numPointsOrigin && numPoints >= minPoints) {
          let wx = x * numPointsOrigin;
          let wy = y * numPointsOrigin;
          let clusterProperties;
          let clusterPropIndex = -1;
          const id = ((i / stride | 0) << 5) + (zoom + 1) + this.points.length;
          for (const neighborId of neighborIds) {
            const k = neighborId * stride;
            if (data[k + OFFSET_ZOOM] <= zoom)
              continue;
            data[k + OFFSET_ZOOM] = zoom;
            const numPoints2 = data[k + OFFSET_NUM];
            wx += data[k] * numPoints2;
            wy += data[k + 1] * numPoints2;
            data[k + OFFSET_PARENT] = id;
            if (reduce) {
              if (!clusterProperties) {
                clusterProperties = this._map(data, i, true);
                clusterPropIndex = this.clusterProps.length;
                this.clusterProps.push(clusterProperties);
              }
              reduce(clusterProperties, this._map(data, k));
            }
          }
          data[i + OFFSET_PARENT] = id;
          nextData.push(wx / numPoints, wy / numPoints, Infinity, id, -1, numPoints);
          if (reduce)
            nextData.push(clusterPropIndex);
        } else {
          for (let j = 0; j < stride; j++)
            nextData.push(data[i + j]);
          if (numPoints > 1) {
            for (const neighborId of neighborIds) {
              const k = neighborId * stride;
              if (data[k + OFFSET_ZOOM] <= zoom)
                continue;
              data[k + OFFSET_ZOOM] = zoom;
              for (let j = 0; j < stride; j++)
                nextData.push(data[k + j]);
            }
          }
        }
      }
      return nextData;
    }
    _getOriginId(clusterId) {
      return clusterId - this.points.length >> 5;
    }
    _getOriginZoom(clusterId) {
      return (clusterId - this.points.length) % 32;
    }
    _map(data, i, clone) {
      if (data[i + OFFSET_NUM] > 1) {
        const props = this.clusterProps[data[i + OFFSET_PROP]];
        return clone ? Object.assign({}, props) : props;
      }
      const original = this.points[data[i + OFFSET_ID]].properties;
      const result = this.options.map(original);
      return clone && result === original ? Object.assign({}, result) : result;
    }
  };
  function getClusterJSON(data, i, clusterProps) {
    return {
      type: "Feature",
      id: data[i + OFFSET_ID],
      properties: getClusterProperties(data, i, clusterProps),
      geometry: {
        type: "Point",
        coordinates: [xLng(data[i]), yLat(data[i + 1])]
      }
    };
  }
  function getClusterProperties(data, i, clusterProps) {
    const count = data[i + OFFSET_NUM];
    const abbrev = count >= 1e4 ? `${Math.round(count / 1e3)}k` : count >= 1e3 ? `${Math.round(count / 100) / 10}k` : count;
    const propIndex = data[i + OFFSET_PROP];
    const properties = propIndex === -1 ? {} : Object.assign({}, clusterProps[propIndex]);
    return Object.assign(properties, {
      cluster: true,
      cluster_id: data[i + OFFSET_ID],
      point_count: count,
      point_count_abbreviated: abbrev
    });
  }
  function lngX(lng) {
    return lng / 360 + 0.5;
  }
  function latY(lat) {
    const sin = Math.sin(lat * Math.PI / 180);
    const y = 0.5 - 0.25 * Math.log((1 + sin) / (1 - sin)) / Math.PI;
    return y < 0 ? 0 : y > 1 ? 1 : y;
  }
  function xLng(x) {
    return (x - 0.5) * 360;
  }
  function yLat(y) {
    const y2 = (180 - y * 360) * Math.PI / 180;
    return 360 * Math.atan(Math.exp(y2)) / Math.PI - 90;
  }

  // node_modules/@googlemaps/markerclusterer/dist/index.esm.mjs
  function __rest(s, e) {
    var t = {};
    for (var p in s)
      if (Object.prototype.hasOwnProperty.call(s, p) && e.indexOf(p) < 0)
        t[p] = s[p];
    if (s != null && typeof Object.getOwnPropertySymbols === "function")
      for (var i = 0, p = Object.getOwnPropertySymbols(s); i < p.length; i++) {
        if (e.indexOf(p[i]) < 0 && Object.prototype.propertyIsEnumerable.call(s, p[i]))
          t[p[i]] = s[p[i]];
      }
    return t;
  }
  typeof SuppressedError === "function" ? SuppressedError : function(error, suppressed, message) {
    var e = new Error(message);
    return e.name = "SuppressedError", e.error = error, e.suppressed = suppressed, e;
  };
  var MarkerUtils = class {
    static isAdvancedMarkerAvailable(map2) {
      return google.maps.marker && map2.getMapCapabilities().isAdvancedMarkersAvailable === true;
    }
    static isAdvancedMarker(marker) {
      return google.maps.marker && marker instanceof google.maps.marker.AdvancedMarkerElement;
    }
    static setMap(marker, map2) {
      if (this.isAdvancedMarker(marker)) {
        marker.map = map2;
      } else {
        marker.setMap(map2);
      }
    }
    static getPosition(marker) {
      if (this.isAdvancedMarker(marker)) {
        if (marker.position) {
          if (marker.position instanceof google.maps.LatLng) {
            return marker.position;
          }
          if (Number.isFinite(marker.position.lat) && Number.isFinite(marker.position.lng)) {
            return new google.maps.LatLng(marker.position.lat, marker.position.lng);
          }
        }
        return new google.maps.LatLng(null);
      }
      return marker.getPosition();
    }
    static getVisible(marker) {
      if (this.isAdvancedMarker(marker)) {
        return true;
      }
      return marker.getVisible();
    }
  };
  var Cluster = class {
    constructor({ markers: markers2, position }) {
      this.markers = [];
      if (markers2)
        this.markers = markers2;
      if (position) {
        if (position instanceof google.maps.LatLng) {
          this._position = position;
        } else {
          this._position = new google.maps.LatLng(position);
        }
      }
    }
    get bounds() {
      if (this.markers.length === 0 && !this._position) {
        return;
      }
      const bounds = new google.maps.LatLngBounds(this._position, this._position);
      for (const marker of this.markers) {
        bounds.extend(MarkerUtils.getPosition(marker));
      }
      return bounds;
    }
    get position() {
      return this._position || this.bounds.getCenter();
    }
    get count() {
      return this.markers.filter((m) => MarkerUtils.getVisible(m)).length;
    }
    push(marker) {
      this.markers.push(marker);
    }
    delete() {
      if (this.marker) {
        MarkerUtils.setMap(this.marker, null);
        this.marker = void 0;
      }
      this.markers.length = 0;
    }
  };
  function assertNotNull(value, message = "assertion failed") {
    if (value === null || value === void 0) {
      throw Error(message);
    }
  }
  var AbstractAlgorithm = class {
    constructor({ maxZoom = 16 }) {
      this.maxZoom = maxZoom;
    }
    noop({ markers: markers2 }) {
      return noop(markers2);
    }
  };
  var noop = (markers2) => {
    const clusters = markers2.map((marker) => new Cluster({
      position: MarkerUtils.getPosition(marker),
      markers: [marker]
    }));
    return clusters;
  };
  var SuperClusterAlgorithm = class extends AbstractAlgorithm {
    constructor(_a) {
      var { maxZoom, radius = 60 } = _a, options = __rest(_a, ["maxZoom", "radius"]);
      super({ maxZoom });
      this.markers = [];
      this.clusters = [];
      this.state = { zoom: -1 };
      this.superCluster = new Supercluster(Object.assign({ maxZoom: this.maxZoom, radius }, options));
    }
    calculate(input) {
      let changed = false;
      let zoom = input.map.getZoom();
      assertNotNull(zoom);
      zoom = Math.round(zoom);
      const state = { zoom };
      if (!deepEqual(input.markers, this.markers)) {
        changed = true;
        this.markers = [...input.markers];
        const points = this.markers.map((marker) => {
          const position = MarkerUtils.getPosition(marker);
          const coordinates = [position.lng(), position.lat()];
          return {
            type: "Feature",
            geometry: { type: "Point", coordinates },
            properties: { marker }
          };
        });
        this.superCluster.load(points);
      }
      if (!changed) {
        if (this.state.zoom <= this.maxZoom || state.zoom <= this.maxZoom) {
          changed = !deepEqual(this.state, state);
        }
      }
      this.state = state;
      if (input.markers.length === 0) {
        this.clusters = [];
        return { clusters: this.clusters, changed };
      }
      if (changed) {
        this.clusters = this.cluster(input);
      }
      return { clusters: this.clusters, changed };
    }
    cluster({ map: map2 }) {
      const zoom = map2.getZoom();
      assertNotNull(zoom);
      return this.superCluster.getClusters([-180, -90, 180, 90], Math.round(zoom)).map((feature) => this.transformCluster(feature));
    }
    transformCluster({ geometry: { coordinates: [lng, lat] }, properties }) {
      if (properties.cluster) {
        return new Cluster({
          markers: this.superCluster.getLeaves(properties.cluster_id, Infinity).map((leaf) => leaf.properties.marker),
          position: { lat, lng }
        });
      }
      const marker = properties.marker;
      return new Cluster({
        markers: [marker],
        position: MarkerUtils.getPosition(marker)
      });
    }
  };
  var ClusterStats = class {
    constructor(markers2, clusters) {
      this.markers = { sum: markers2.length };
      const clusterMarkerCounts = clusters.map((a) => a.count);
      const clusterMarkerSum = clusterMarkerCounts.reduce((a, b) => a + b, 0);
      this.clusters = {
        count: clusters.length,
        markers: {
          mean: clusterMarkerSum / clusters.length,
          sum: clusterMarkerSum,
          min: Math.min(...clusterMarkerCounts),
          max: Math.max(...clusterMarkerCounts)
        }
      };
    }
  };
  var DefaultRenderer = class {
    render({ count, position }, stats, map2) {
      const color = count > Math.max(10, stats.clusters.markers.mean) ? "#ff0000" : "#0000ff";
      const svg = `<svg fill="${color}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" width="50" height="50">
<circle cx="120" cy="120" opacity=".6" r="70" />
<circle cx="120" cy="120" opacity=".3" r="90" />
<circle cx="120" cy="120" opacity=".2" r="110" />
<text x="50%" y="50%" style="fill:#fff" text-anchor="middle" font-size="50" dominant-baseline="middle" font-family="roboto,arial,sans-serif">${count}</text>
</svg>`;
      const title = `Cluster of ${count} markers`, zIndex = Number(google.maps.Marker.MAX_ZINDEX) + count;
      if (MarkerUtils.isAdvancedMarkerAvailable(map2)) {
        const parser = new DOMParser();
        const svgEl = parser.parseFromString(svg, "image/svg+xml").documentElement;
        svgEl.setAttribute("transform", "translate(0 25)");
        const clusterOptions2 = {
          map: map2,
          position,
          zIndex,
          title,
          content: svgEl
        };
        return new google.maps.marker.AdvancedMarkerElement(clusterOptions2);
      }
      const clusterOptions = {
        position,
        zIndex,
        title,
        icon: {
          url: `data:image/svg+xml;base64,${btoa(svg)}`,
          anchor: new google.maps.Point(25, 25)
        }
      };
      return new google.maps.Marker(clusterOptions);
    }
  };
  function extend(type1, type2) {
    for (let property in type2.prototype) {
      type1.prototype[property] = type2.prototype[property];
    }
  }
  var OverlayViewSafe = class {
    constructor() {
      extend(OverlayViewSafe, google.maps.OverlayView);
    }
  };
  var MarkerClustererEvents;
  (function(MarkerClustererEvents2) {
    MarkerClustererEvents2["CLUSTERING_BEGIN"] = "clusteringbegin";
    MarkerClustererEvents2["CLUSTERING_END"] = "clusteringend";
    MarkerClustererEvents2["CLUSTER_CLICK"] = "click";
    MarkerClustererEvents2["GMP_CLICK"] = "gmp-click";
  })(MarkerClustererEvents || (MarkerClustererEvents = {}));
  var defaultOnClusterClickHandler = (_, cluster, map2) => {
    if (cluster.bounds)
      map2.fitBounds(cluster.bounds);
  };
  var MarkerClusterer = class extends OverlayViewSafe {
    constructor({ map: map2, markers: markers2 = [], algorithmOptions = {}, algorithm = new SuperClusterAlgorithm(algorithmOptions), renderer = new DefaultRenderer(), onClusterClick = defaultOnClusterClickHandler }) {
      super();
      this.map = null;
      this.idleListener = null;
      this.markers = [...markers2];
      this.clusters = [];
      this.algorithm = algorithm;
      this.renderer = renderer;
      this.onClusterClick = onClusterClick;
      if (map2) {
        this.setMap(map2);
      }
    }
    addMarker(marker, noDraw) {
      if (this.markers.includes(marker)) {
        return;
      }
      this.markers.push(marker);
      if (!noDraw) {
        this.render();
      }
    }
    addMarkers(markers2, noDraw) {
      markers2.forEach((marker) => {
        this.addMarker(marker, true);
      });
      if (!noDraw) {
        this.render();
      }
    }
    removeMarker(marker, noDraw) {
      const index = this.markers.indexOf(marker);
      if (index === -1) {
        return false;
      }
      MarkerUtils.setMap(marker, null);
      this.markers.splice(index, 1);
      if (!noDraw) {
        this.render();
      }
      return true;
    }
    removeMarkers(markers2, noDraw) {
      let removed = false;
      markers2.forEach((marker) => {
        removed = this.removeMarker(marker, true) || removed;
      });
      if (removed && !noDraw) {
        this.render();
      }
      return removed;
    }
    clearMarkers(noDraw) {
      this.markers.length = 0;
      if (!noDraw) {
        this.render();
      }
    }
    render() {
      const map2 = this.getMap();
      if (map2 instanceof google.maps.Map && map2.getProjection()) {
        google.maps.event.trigger(this, MarkerClustererEvents.CLUSTERING_BEGIN, this);
        const { clusters, changed } = this.algorithm.calculate({
          markers: this.markers,
          map: map2,
          mapCanvasProjection: this.getProjection()
        });
        if (changed || changed == void 0) {
          const singleMarker = new Set();
          for (const cluster of clusters) {
            if (cluster.markers.length == 1) {
              singleMarker.add(cluster.markers[0]);
            }
          }
          const groupMarkers = [];
          for (const cluster of this.clusters) {
            if (cluster.marker == null) {
              continue;
            }
            if (cluster.markers.length == 1) {
              if (!singleMarker.has(cluster.marker)) {
                MarkerUtils.setMap(cluster.marker, null);
              }
            } else {
              groupMarkers.push(cluster.marker);
            }
          }
          this.clusters = clusters;
          this.renderClusters();
          requestAnimationFrame(() => groupMarkers.forEach((marker) => MarkerUtils.setMap(marker, null)));
        }
        google.maps.event.trigger(this, MarkerClustererEvents.CLUSTERING_END, this);
      }
    }
    onAdd() {
      const map2 = this.getMap();
      assertNotNull(map2);
      this.idleListener = map2.addListener("idle", this.render.bind(this));
      this.render();
    }
    onRemove() {
      if (this.idleListener)
        google.maps.event.removeListener(this.idleListener);
      this.reset();
    }
    reset() {
      this.markers.forEach((marker) => MarkerUtils.setMap(marker, null));
      this.clusters.forEach((cluster) => cluster.delete());
      this.clusters = [];
    }
    renderClusters() {
      const stats = new ClusterStats(this.markers, this.clusters);
      const map2 = this.getMap();
      this.clusters.forEach((cluster) => {
        if (cluster.markers.length === 1) {
          cluster.marker = cluster.markers[0];
        } else {
          cluster.marker = this.renderer.render(cluster, stats, map2);
          cluster.markers.forEach((marker) => MarkerUtils.setMap(marker, null));
          if (this.onClusterClick) {
            const markerClickEventName = MarkerUtils.isAdvancedMarker(cluster.marker) ? MarkerClustererEvents.GMP_CLICK : MarkerClustererEvents.CLUSTER_CLICK;
            cluster.marker.addListener(markerClickEventName, (event) => {
              google.maps.event.trigger(this, MarkerClustererEvents.CLUSTER_CLICK, cluster);
              this.onClusterClick(event, cluster, map2);
            });
          }
        }
        MarkerUtils.setMap(cluster.marker, map2);
      });
    }
  };

  // resources/js/service-locator.js
  var addToSessionStorageObject = function(name, key, value) {
    var existing = sessionStorage.getItem(name);
    existing = existing ? JSON.parse(existing) : {};
    existing[key] = value;
    sessionStorage.setItem(name, JSON.stringify(existing));
  };
  var radius_circle;
  var geocoder;
  var markers = [];
  var map;
  var markerClusterer;
  var mapCenter = { lat: -30.48941970550993, lng: 133.59244824999996 };
  var radius_km = 30;
  var location_distance;
  var markerImage = websiteData.urlTheme + "/assets/images/service-locator/common-location-purple.png";
  var centerMarkerImage = websiteData.urlTheme + "/assets/images/service-locator/bluedot48.png";
  jQuery(function($) {
    function setMapHeight() {
      const site_header_height = $(".site-header").outerHeight();
      const service_locator_form_height = $(".service_locator-search").outerHeight();
      const service_locator_infobar_height = 0;
      const map_height = $(window).height() - site_header_height + 150;
      $(".service_locator-map").css("height", map_height + "px");
      $(".service_locator-sidepane").css("height", "auto");
      $(".service_locator-listing").css("height", "auto");
      if (window.matchMedia("(max-width: 1024px)").matches) {
      }
      if (window.matchMedia("(min-width: 1024px)").matches) {
        $(".service_locator-content_wrapper").css("height", map_height + "px");
        $(".service_locator").css("height", map_height + "px");
        $(".service_locator-sidepane").css("height", map_height + "px");
      }
    }
    setMapHeight();
    $(window).resize(function() {
      setMapHeight();
    });
    function initializeMap() {
      const mapStyle = [
        {
          elementType: "geometry",
          stylers: [
            {
              color: "#e6e6e6"
            }
          ]
        },
        {
          elementType: "labels.icon",
          stylers: [
            {
              visibility: "off"
            }
          ]
        },
        {
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#616161"
            }
          ]
        },
        {
          elementType: "labels.text.stroke",
          stylers: [
            {
              color: "#e6e6e6"
            }
          ]
        },
        {
          featureType: "administrative.land_parcel",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#bdbdbd"
            }
          ]
        },
        {
          featureType: "poi",
          elementType: "geometry",
          stylers: [
            {
              color: "#eeeeee"
            }
          ]
        },
        {
          featureType: "poi",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#757575"
            }
          ]
        },
        {
          featureType: "poi.park",
          elementType: "geometry",
          stylers: [
            {
              color: "#e5e5e5"
            }
          ]
        },
        {
          featureType: "poi.park",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#9e9e9e"
            }
          ]
        },
        {
          featureType: "road",
          elementType: "geometry",
          stylers: [
            {
              color: "#ffffff"
            }
          ]
        },
        {
          featureType: "road.arterial",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#757575"
            }
          ]
        },
        {
          featureType: "road.highway",
          elementType: "geometry",
          stylers: [
            {
              color: "#dadada"
            }
          ]
        },
        {
          featureType: "road.highway",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#616161"
            }
          ]
        },
        {
          featureType: "road.local",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#9e9e9e"
            }
          ]
        },
        {
          featureType: "transit.line",
          elementType: "geometry",
          stylers: [
            {
              color: "#e5e5e5"
            }
          ]
        },
        {
          featureType: "transit.station",
          elementType: "geometry",
          stylers: [
            {
              color: "#eeeeee"
            }
          ]
        },
        {
          featureType: "water",
          elementType: "geometry",
          stylers: [
            {
              color: "#c9c9c9"
            }
          ]
        },
        {
          featureType: "water",
          elementType: "labels.text.fill",
          stylers: [
            {
              color: "#9e9e9e"
            }
          ]
        }
      ];
      if (window.matchMedia("(min-width: 60rem)").matches) {
        var mapZoom = 5;
        var mapMinZoom = 5;
        var mapMaxZoom = 18;
      } else {
        var mapZoom = 4;
        var mapMinZoom = 4;
        var mapMaxZoom = 18;
      }
      map = new google.maps.Map(document.getElementById("service_locator-map"), {
        zoom: mapZoom,
        minZoom: mapMinZoom,
        maxZoom: mapMaxZoom,
        center: mapCenter,
        styles: mapStyle,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false,
        zoomControl: true,
        zoomControlOptions: {
          position: google.maps.ControlPosition.TOP_RIGHT
        }
      });
      geocoder = new google.maps.Geocoder();
      var initMapCenter = map.getCenter();
      var providerJson = "/wp-json/wp/v2/service-partner?status=publish&per_page=500";
      var searchBoxInput = document.getElementById("pac-input");
      var searchBox = new google.maps.places.Autocomplete(searchBoxInput, {
        types: ["(regions)"],
        componentRestrictions: { country: "au" }
      });
      putMarkers("", providerJson, initMapCenter);
      serviceLocatorList(providerJson);
      postcodeAutocomplete(providerJson);
      searchSuburbListener(searchBox);
      sessionStorage.removeItem("service_locator");
      addToSessionStorageObject("service_locator", "provider_data", providerJson);
      addToSessionStorageObject("service_locator", "service_category", "");
      addToSessionStorageObject("service_locator", "pin_address", "");
    }
    window.addEventListener("load", initializeMap, { once: true });
    function putMarkers(type, serviceProvider, pinLatLng, radius) {
      $(".service_locator-listing_tabs").empty();
      $(".service_locator-progress").css("z-index", 100).animate({ opacity: 1 }, 300);
      $.getJSON(serviceProvider, function(data) {
        let num = 0;
        let nearby_provider_obj = [];
        $.each(data, function(key, value) {
          var provider_id = value.id;
          var title = value.title.rendered;
          var lat = value.acf.location.lat;
          var lng = value.acf.location.lng;
          var latLng = new google.maps.LatLng(lat, lng);
          var location_name = value.title.rendered;
          var location_city = value.acf.location.city;
          var location_postcode = value.acf.location.post_code;
          var service_types = value.service_types;
          var location_address = value.acf.location.address;
          var link = value.link;
          var location_lat = value.acf.location.lat;
          var location_lng = value.acf.location.lng;
          var contact_numbers = value.acf.contact_numbers;
          if (type == "nearby") {
            var distance_from_location = google.maps.geometry.spherical.computeDistanceBetween(pinLatLng, latLng);
            if (distance_from_location <= radius * 1e3) {
              var list_provider_obj = {
                id: provider_id,
                distance: distance_from_location,
                latitude: lat,
                longitude: lng,
                location_name,
                location_city,
                location_postcode,
                service_types,
                location_address,
                link,
                location_lat,
                location_lng,
                contact_numbers
              };
              nearby_provider_obj.push(list_provider_obj);
              var marker = new google.maps.Marker({
                position: latLng,
                map,
                icon: markerImage
              });
              markers.push(marker);
              var service_type_tags = "";
              for (var i = 0; i < service_types.length; i++) {
                var tag = $.map(service_types_tax, function(val) {
                  return val.term_id == service_types[i] ? val.term_name : null;
                });
                service_type_tags += '<span class="inline-block text-[11px] px-3 py-0.5 rounded-md bg-white border border-brand-sea text-brand-sea">' + tag[0] + "</span>";
              }
              var list_contact_numbers = "";
              if (contact_numbers) {
                contact_numbers.forEach(function(element) {
                  var tel = element.phone_number;
                  tel = tel.replace(/\s+/g, "");
                  list_contact_numbers += '<div class="mb-1">' + element.phone_label + ':&nbsp;<a href="tel:' + tel + '" class="underline font-medium hover:no-underline">' + element.phone_number + "</a></div>";
                });
              }
              var activeInfoWindow;
              var infowindow = new google.maps.InfoWindow();
              google.maps.event.addListener(marker, "click", function(evt) {
                map.panTo(marker.getPosition());
                var contentString = "<div class='max-w-md p-2'><h4 class='text-lg font-bold mb-2'>" + title + "</h4><div class='flex flex-wrap gap-3 mb-3'>" + service_type_tags + "</div><div class='mb-3'>" + location_address + ". <a href='https://www.google.com/maps/dir/?api=1&destination=" + lat + "," + lng + "' target='_blank' class='underline font-medium hover:no-underline'>Get Direction</a></div><div class='mb-3'>" + list_contact_numbers + "</div><div class='mt-8 flex gap-x-4'><a href='" + link + "' class='uppercase text-brand-sea font-semibold hover:underline'>More Details</a><a href='" + link + "#enquiry-form' class='uppercase text-brand-sea font-semibold hover:underline'>Register</a></div></div></div>";
                infowindow.close();
                infowindow.setContent(contentString);
                infowindow.open({
                  anchor: marker,
                  map
                });
              });
              num++;
            }
          } else {
            var distance_from_location = google.maps.geometry.spherical.computeDistanceBetween(pinLatLng, latLng);
            var list_provider_obj = {
              id: provider_id,
              distance: distance_from_location,
              latitude: lat,
              longitude: lng,
              location_name,
              location_city,
              location_postcode,
              service_types,
              location_address,
              link,
              location_lat,
              location_lng,
              contact_numbers
            };
            nearby_provider_obj.push(list_provider_obj);
            var marker = new google.maps.Marker({
              position: latLng,
              map,
              icon: markerImage
            });
            markers.push(marker);
            var service_type_tags = "";
            for (var i = 0; i < service_types.length; i++) {
              var tag = $.map(service_types_tax, function(val) {
                return val.term_id == service_types[i] ? val.term_name : null;
              });
              service_type_tags += '<span class="inline-block text-[11px] px-3 py-0.5 rounded-md bg-white border border-brand-sea text-brand-sea">' + tag[0] + "</span>";
            }
            var list_contact_numbers = "";
            if (contact_numbers) {
              contact_numbers.forEach(function(element) {
                var tel = element.phone_number;
                tel = tel.replace(/\s+/g, "");
                list_contact_numbers += '<div class="mb-1">' + element.phone_label + ':&nbsp;<a href="tel:' + tel + '" class="underline font-medium hover:no-underline">' + element.phone_number + "</a></div>";
              });
            }
            var activeInfoWindow;
            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(marker, "click", function(evt) {
              map.panTo(marker.getPosition());
              var contentString = "<div class='max-w-md p-2'><h4 class='text-lg font-bold mb-2'>" + title + "</h4><div class='flex flex-wrap gap-3 mb-3'>" + service_type_tags + "</div><div class='mb-3'>" + location_address + ". <a href='https://www.google.com/maps/dir/?api=1&destination=" + lat + "," + lng + "' target='_blank' class='underline font-medium hover:no-underline'>Get Direction</a></div><div class='mb-3'>" + list_contact_numbers + "</div><div class='mt-8 flex gap-x-4'><a href='" + link + "' class='uppercase text-brand-sea font-semibold hover:underline'>More Details</a><a href='" + link + "#enquiry-form' class='uppercase text-brand-sea font-semibold hover:underline'>Register</a></div></div></div>";
              infowindow.close();
              infowindow.setContent(contentString);
              infowindow.open({
                anchor: marker,
                map
              });
            });
            num++;
          }
        });
        var nearby_provider = nearby_provider_obj.sort((a, b) => a.distance > b.distance ? 1 : -1);
        if (nearby_provider.length === 0) {
        }
        nearby_provider.forEach((element, index, array) => {
          serviceProviderItem(element.id, element.location_name, element.location_city, element.location_postcode, element.distance, element.service_types, element.location_address, element.link, element.location_lat, element.location_lng, element.contact_numbers);
        });
        markerClusterer = new MarkerClusterer({
          markers,
          map,
          algorithmOptions: {
            gridSize: 68
          },
          renderer: {
            render: ({ count, position }) => new google.maps.Marker({
              label: {
                text: String(count),
                color: "white",
                fontSize: "14px",
                fontWeight: "bold"
              },
              position,
              icon: {
                url: "/wp-content/themes/coact/assets/images/service-locator/common-cluster.png",
                scaledSize: new google.maps.Size(40, 40)
              },
              zIndex: 1e3 + count
            })
          }
        });
        if (type == "nearby") {
          if (num > 0) {
            var provider_result = "Showing " + num + " Sites";
            $(".service_locator-listing_title").html(provider_result);
          } else {
            var provider_result = "Sorry, no service providers found";
            $(".service_locator-listing_title").html(provider_result);
          }
        } else {
          var provider_result = "Showing " + num + " Sites";
          $(".service_locator-listing_title").html(provider_result);
        }
      }).done(function(data) {
        $(".service_locator-progress").css("z-index", -1).animate({ opacity: 0 }, 300);
      });
    }
    function getNearestSitesRadius(serviceProvider, pinLatLng, radiusKm) {
      let res = 0;
      let radius = radiusKm;
      for (let i = 0; res < 1; i++) {
        $.ajax({
          url: serviceProvider,
          async: false,
          success: function(data) {
            let nearby_provider_obj = [];
            $.each(data, function(key, value) {
              var provider_id = value.id;
              var title = value.title.rendered;
              var lat = value.acf.location.lat;
              var lng = value.acf.location.lng;
              var latLng = new google.maps.LatLng(lat, lng);
              var location_name = value.title.rendered;
              var location_city = value.acf.location.city;
              var location_postcode = value.acf.location.post_code;
              var service_types = value.service_types;
              var location_address = value.acf.location.address;
              var link = value.link;
              var location_lat = value.acf.location.lat;
              var location_lng = value.acf.location.lng;
              var contact_numbers = value.acf.contact_numbers;
              let distance_from_location = google.maps.geometry.spherical.computeDistanceBetween(pinLatLng, latLng);
              if (distance_from_location <= radius * 1e3) {
                let list_provider_obj = {
                  id: provider_id,
                  distance: distance_from_location,
                  latitude: lat,
                  longitude: lng,
                  location_name,
                  location_city,
                  location_postcode,
                  service_types,
                  location_address,
                  link,
                  location_lat,
                  location_lng,
                  contact_numbers
                };
                nearby_provider_obj.push(list_provider_obj);
              }
            });
            let nearby_provider = nearby_provider_obj.sort((a, b) => a.distance > b.distance ? 1 : -1);
            res = nearby_provider.length;
            if (res == 0) {
              radius = radius + 50;
            } else {
              res = 1;
            }
          }
        });
      }
      return radius;
    }
    function serviceLocatorList(serviceProvider) {
      $.getJSON(serviceProvider, function(data) {
        $.each(data, function(key, value) {
          var provider_id = value.id;
          var location_name = value.title.rendered;
          var location_address = value.acf.location.address;
          var location_city = value.acf.location.city;
          var location_postcode = value.acf.location.post_code;
          var service_types = value.service_types;
          var link = value.link;
          var location_lat = value.acf.location.lat;
          var location_lng = value.acf.location.lng;
          var contact_numbers = value.acf.contact_numbers;
          serviceProviderItem(provider_id, location_name, location_city, location_postcode, location_distance, service_types, location_address, link, location_lat, location_lng, contact_numbers);
        });
      }).done(function(data) {
      });
    }
    function createProviderItem(link, location_name, location_address, map_url, new_enquiries, existing_client, service_type_tags) {
      return `
      <li class="block bg-[#F4F4F4]">
          <div class="pl-14 pr-8 pt-4 pb-4">
              <h4 class="text-lg leading-tight font-bold mb-2">
                  <a href="${link}" class="hover:underline">${location_name}</a>
              </h4>
              <div class="relative">
                  <svg class="absolute -left-10 h-6 w-6" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M42.6656 18.3328C42.6649 14.9472 41.7267 11.628 39.955 8.74296C38.1834 5.85795 35.6474 3.51988 32.6282 1.98794C29.6091 0.455994 26.2247 -0.20999 22.8502 0.0638118C19.4757 0.337613 16.2429 1.5405 13.5102 3.53914C10.7775 5.53778 8.65168 8.2541 7.36828 11.387C6.08488 14.5199 5.69409 17.947 6.23921 21.2884C6.78434 24.6298 8.24409 27.755 10.4567 30.3176C12.6692 32.8801 15.5482 34.7799 18.7744 35.8064L24.2912 48L29.7632 35.848C33.5015 34.6876 36.7704 32.3616 39.0919 29.2101C41.4134 26.0586 42.6657 22.247 42.6656 18.3328ZM24.3328 26.08C22.8006 26.08 21.3027 25.6256 20.0287 24.7744C18.7547 23.9231 17.7617 22.7132 17.1753 21.2975C16.589 19.8819 16.4355 18.3242 16.7345 16.8214C17.0334 15.3186 17.7712 13.9382 18.8547 12.8547C19.9382 11.7713 21.3186 11.0334 22.8214 10.7345C24.3242 10.4355 25.8819 10.589 27.2975 11.1753C28.7131 11.7617 29.9231 12.7547 30.7744 14.0287C31.6256 15.3027 32.08 16.8006 32.08 18.3328C32.0802 19.3503 31.88 20.3578 31.4907 21.2978C31.1015 22.2378 30.5308 23.0919 29.8114 23.8114C29.0919 24.5308 28.2378 25.1015 27.2978 25.4907C26.3578 25.88 25.3502 26.0802 24.3328 26.08Z" fill="#000000" />
                  </svg>
                  <div class="text-sm">${location_address}<br />
                      <a href="${map_url}" target="_blank" class="text-brand-blue font-medium underline">Get Directions</a>
                  </div>
              </div>
              <div class="text-sm my-4">
                  New enquiries: <a href="tel:61${new_enquiries.split(" ").join("")}" class="text-brand-blue underline hover:no-underline">${new_enquiries}</a><br />
                  Existing clients: <a href="tel:61${existing_client.split(" ").join("")}" class="text-brand-blue underline hover:no-underline">${existing_client}</a>
              </div>
              <div class="mt-4">
                  <div class="flex flex-wrap gap-3">${service_type_tags}</div>
              </div>
          </div>
          <div class="flex bg-[#E2E2E2] border-t border-b border-[#CCCCCC]">
              <div class="w-1/2 border-r border-[#CCC]">
                  <a href="${link}/#enquiry-form" class="inline-flex gap-3 items-center hover:underline px-8 py-3">
                      <svg class="w-4 h-4 text-brand-purple" width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M24.1072 0C19.3604 0 14.7203 1.40758 10.7735 4.04473C6.82672 6.68188 3.75058 10.4302 1.93408 14.8156C0.117577 19.201 -0.357704 24.0266 0.568342 28.6822C1.49439 33.3377 3.78017 37.6141 7.13663 40.9706C10.4931 44.327 14.7695 46.6128 19.425 47.5388C24.0806 48.4649 28.9062 47.9896 33.2916 46.1731C37.677 44.3566 41.4253 41.2805 44.0625 37.3337C46.6996 33.3869 48.1072 28.7468 48.1072 24C48.1072 17.6348 45.5786 11.5303 41.0778 7.02944C36.5769 2.52856 30.4724 0 24.1072 0ZM21.0368 38.6192L16.04 33.6208L25.6592 24L16.04 14.3808L21.0368 9.384L35.656 24L21.0368 38.6192Z" fill="currentColor" />
                      </svg>
                      <span class="text-black font-bold text-sm">Register</span>
                  </a>
              </div>
              <div class="w-1/2">
                  <a href="${link}" class="inline-flex gap-3 items-center hover:underline px-4 lg:px-8 py-3">
                      <svg class="w-4 h-4 text-brand-purple" width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M24.1072 0C19.3604 0 14.7203 1.40758 10.7735 4.04473C6.82672 6.68188 3.75058 10.4302 1.93408 14.8156C0.117577 19.201 -0.357704 24.0266 0.568342 28.6822C1.49439 33.3377 3.78017 37.6141 7.13663 40.9706C10.4931 44.327 14.7695 46.6128 19.425 47.5388C24.0806 48.4649 28.9062 47.9896 33.2916 46.1731C37.677 44.3566 41.4253 41.2805 44.0625 37.3337C46.6996 33.3869 48.1072 28.7468 48.1072 24C48.1072 17.6348 45.5786 11.5303 41.0778 7.02944C36.5769 2.52856 30.4724 0 24.1072 0ZM21.0368 38.6192L16.04 33.6208L25.6592 24L16.04 14.3808L21.0368 9.384L35.656 24L21.0368 38.6192Z" fill="currentColor" />
                      </svg>
                      <span class="text-black font-bold text-sm">More details</span>
                  </a>
              </div>
          </div>
      </li>`;
    }
    function serviceProviderItem(provider_id, location_name, location_city, location_postcode, location_distance2, service_types, location_address, link, location_lat, location_lng, contact_numbers) {
      if (!location_distance2) {
        location_distance2 = "";
      } else {
        location_distance2 = location_distance2 / 1e3;
        location_distance2 = '<span class="inline-block">&nbsp;&nbsp;|&nbsp;&nbsp;~' + location_distance2.toFixed(2) + " km</span>";
      }
      var service_type_tags = "";
      for (var i = 0; i < service_types.length; i++) {
        var tag = $.map(service_types_tax, function(val) {
          return val.term_id == service_types[i] ? val.term_name : null;
        });
        service_type_tags += '<span class="inline-block text-[11px] px-3 py-1 rounded-md bg-brand-sea border border-brand-sea text-black font-medium shadow-sm">' + tag[0] + "</span>";
      }
      var map_url = "https://www.google.com/maps/dir/?api=1&destination=" + location_lat + "," + location_lng;
      var new_enquiries = "";
      var existing_client = "";
      if (contact_numbers) {
        if (contact_numbers[0]) {
          new_enquiries = contact_numbers[0].phone_number;
        }
        if (contact_numbers[1]) {
          existing_client = contact_numbers[1].phone_number;
        }
      }
      $(".service_locator-listing_tabs").append(createProviderItem(link, location_name, location_address, map_url, new_enquiries, existing_client, service_type_tags));
    }
    $(".select_service_type").select2({
      placeholder: "Select a service type",
      allowClear: true,
      minimumResultsForSearch: Infinity,
      dropdownParent: $(".service_locator-panel")
    });
    $(".select_service_type").on("select2:select", function(e) {
      var data = e.params.data;
      var service_provider_category = data.id;
      $("#input_postcode").val("");
      $(".service_locator-postcode .btn-clear").hide();
      selectServiceType(service_provider_category);
    });
    $(".select_service_type").on("select2:clear", function(e) {
      var service_provider_category = "";
      $("#input_postcode").val("");
      $(".service_locator-postcode .btn-clear").hide();
      selectServiceType(service_provider_category);
    });
    function selectServiceType(service_provider_category) {
      if (service_provider_category) {
        var providerJson = "/wp-json/wp/v2/service-partner?status=publish&service_types=" + service_provider_category + "&per_page=500";
      } else {
        var providerJson = "/wp-json/wp/v2/service-partner?status=publish&per_page=500";
      }
      addToSessionStorageObject("service_locator", "service_category", service_provider_category);
      addToSessionStorageObject("service_locator", "provider_data", providerJson);
      if (radius_circle) {
        radius_circle.setMap(null);
        radius_circle = null;
      }
      deleteMarkers();
      markerClusterer.clearMarkers();
      $(".service_locator-listing_tabs").empty();
      var markCenter = map.getCenter();
      putMarkers("", providerJson, markCenter);
      map.setCenter(mapCenter);
      map.panTo(mapCenter);
      map.setZoom(5);
    }
    function postcodeAutocomplete(serviceProvider) {
      const input = document.getElementById("input_postcode");
      enableEnterKey(input);
      const autocomplete = new google.maps.places.Autocomplete(input, {
        types: ["(regions)"],
        componentRestrictions: { country: "au" }
      });
      autocomplete.addListener("place_changed", function() {
        var address = $("#input_postcode").val();
        var sessionObj = JSON.parse(sessionStorage.getItem("service_locator"));
        var providerJson = sessionObj.provider_data;
        const place = autocomplete.getPlace();
        if (!place.place_id) {
          return;
        }
        addToSessionStorageObject("service_locator", "provider_data", providerJson);
        addToSessionStorageObject("service_locator", "pin_address", address);
        showNearbySites(providerJson, address);
      });
    }
    $("#input_postcode").on("keyup blur", function(event) {
      if ($(this).val().length != 0) {
        $(".service_locator-postcode .btn-clear").show();
      }
    });
    $(document).on("click", ".service_locator-postcode .btn-clear", function(e) {
      e.preventDefault();
      $("#input_postcode").val("");
      $(".service_locator-postcode .btn-clear").hide();
      $(".select_service_type").trigger({
        type: "select2:clear"
      });
      $(".select_service_type").val(null).trigger("change");
    });
    function enableEnterKey(input) {
      const _addEventListener = input.addEventListener;
      const addEventListenerWrapper = function(type, listener) {
        if (type === "keydown") {
          const _listener = listener;
          listener = function(event) {
            const suggestionSelected = document.getElementsByClassName("pac-item-selected").length;
            if (event.key === "Enter" && !suggestionSelected) {
              const e = new KeyboardEvent("keydown", {
                key: "ArrowDown",
                code: "ArrowDown",
                keyCode: 40
              });
              _listener.apply(input, [e]);
            }
            _listener.apply(input, [event]);
          };
        }
        _addEventListener.apply(input, [type, listener]);
      };
      input.addEventListener = addEventListenerWrapper;
    }
    $(document).on("click", ".button-suburb", function(e) {
      var buttonText = $(this).text();
      $("#pac-input").val(buttonText);
      function noop2() {
      }
      var searchBoxInput = document.getElementById("pac-input");
      google.maps.event.trigger(searchBoxInput, "focus", {});
      setTimeout(() => {
        google.maps.event.trigger(searchBoxInput, "keydown", {
          keyCode: 40,
          stopPropagation: noop2,
          preventDefault: noop2
        });
        google.maps.event.trigger(searchBoxInput, "keydown", { keyCode: 13 });
        google.maps.event.trigger(this, "focus", {});
      }, 500);
      document.getElementById("service-locator").scrollIntoView({ behavior: "smooth" });
    });
    function searchSuburbListener(searchBox) {
      google.maps.event.addListener(searchBox, "place_changed", function() {
        var address = $("#pac-input").val();
        var sessionObj = JSON.parse(sessionStorage.getItem("service_locator"));
        var providerJson = sessionObj.provider_data;
        const place = searchBox.getPlace();
        if (!place.place_id) {
          return;
        }
        $("#pac-input").val("");
        addToSessionStorageObject("service_locator", "provider_data", providerJson);
        addToSessionStorageObject("service_locator", "pin_address", address);
        showNearbySites(providerJson, address);
      });
    }
    function showNearbySites(serviceProvider, address) {
      if (radius_circle) {
        radius_circle.setMap(null);
        radius_circle = null;
      }
      deleteMarkers();
      markerClusterer.clearMarkers();
      $("#service_locator-list").empty();
      if (geocoder) {
        geocoder.geocode({ address }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
              var pinLatLng = results[0].geometry.location;
              let radiusKm = radius_km;
              let radius = getNearestSitesRadius(serviceProvider, pinLatLng, radiusKm);
              radius_circle = new google.maps.Circle({
                center: pinLatLng,
                radius: radius * 1e3,
                strokeColor: "#B86AAB",
                strokeOpacity: 0.6,
                strokeWeight: 2,
                fillColor: "#B86AAB",
                fillOpacity: 0.1,
                clickable: false,
                map
              });
              if (radius_circle) {
                map.fitBounds(radius_circle.getBounds());
              }
              putMarkers("nearby", serviceProvider, pinLatLng, radius);
            } else {
              console.log("No results found while geocoding!");
            }
          } else {
            console.log("Geocode was not successful: " + status);
          }
        });
      }
    }
    $(document).on("click", ".link_overlay-btn", function(e) {
      e.preventDefault();
      var data_id = $(this).data("id");
    });
    function serviceLocatorPane(provider_id) {
      $(".service_locator-progress").css("z-index", 100).animate({ opacity: 1 }, 300);
      $.getJSON("/wp-json/wp/v2/service-partner/" + provider_id, function(data) {
        var title = data.title.rendered;
        var service_types_data = data.service_types;
        var details_service_type = "";
        for (var i = 0; i < service_types_data.length; i++) {
          var tag = $.map(service_types_tax, function(val) {
            return val.term_id == service_types_data[i] ? val.term_name : null;
          });
          if (i > 0) {
            details_service_type += '&comma;&nbsp;<span class="service_locator-listing_tag tag">' + tag[0] + "</span>";
          } else {
            details_service_type += '<span class="service_locator-listing_tag tag">' + tag[0] + "</span>";
          }
        }
        var contact_numbers = data.acf.contact_numbers;
        var list_contact_numbers = "";
        if (contact_numbers) {
          contact_numbers.forEach(function(element) {
            var tel = element.phone_number;
            tel = tel.replace(/\s+/g, "");
            list_contact_numbers += '<div class="service_locator-proofPoint"><span class="svg_icon"><div><div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="injected-svg" data-src="/wp-content/themes/coact/assets/images/service-locator/common-phone.svg"><path class="svg_inherit" d="M6.62 10.79a15.15 15.15 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.02-.24c1.12.37 2.33.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1.02l-2.2 2.2z"></path></svg></div></div></span><a href="tel:' + tel + '" class="phantom-phone-number">' + element.phone_label + ":&nbsp;" + element.phone_number + "</a></div>";
          });
        }
        var address_data = data.acf.location.address;
        var description_data = data.acf.description;
        var checkmark_data = data.acf.checkmark_list;
        var checkmark_list = "";
        if (checkmark_data) {
          checkmark_data.forEach(function(element) {
            checkmark_list += '<div class="service_locator-proofPoint"><span class="svg_icon"><div><div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="injected-svg" data-src="/wp-content/themes/coact/assets/images/service-locator/common-tick.svg"><title>icon / tick</title><g fill="none" fill-rule="evenodd"><path d="M0 0h24v24H0z"></path><path fill="#45C2BF" fill-rule="nonzero" d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z"></path></g></svg></div></div></span><span>' + element.point + "</span></div>";
          });
        }
        var link_data = data.link;
        var details_body = "";
        details_body += '<div class="service_locator-details_title details_block">';
        if (title) {
          details_body += "<h3>" + title + "</h3>";
        }
        if (details_service_type) {
          details_body += '<div class="service_locator-details_tags"><div class="tags">';
          details_body += details_service_type;
          details_body += "</div></div>";
        }
        details_body += "</div>";
        details_body += '<div class="details_block">';
        details_body += '<div class="service_locator-details_contact list_block">';
        if (address_data) {
          details_body += '<div class="service_locator-proofPoint"><span class="svg_icon"><div><div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="injected-svg" data-src="/wp-content/themes/coact/assets/images/service-locator/common-location.svg"><path class="svg_inherit" d="M12 0C7.3 0 3.5 3.76 3.5 8.4 3.5 14.7 12 24 12 24s8.5-9.3 8.5-15.6C20.5 3.76 16.7 0 12 0zm0 12a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7z"></path></svg></div></div></span><span>' + address_data + "</span></div>";
        }
        if (list_contact_numbers) {
          details_body += list_contact_numbers;
        }
        details_body += "</div>";
        if (description_data) {
          details_body += '<div class="service_locator-details_description">' + description_data + "</div>";
        }
        details_body += "</div>";
        if (checkmark_list) {
          details_body += '<div class="service_locator-details_proofpoints details_block list_block">';
          details_body += checkmark_list;
          details_body += "</div>";
        }
        $(".service_locator-details_body").append(details_body);
        details_footer = "";
        if (link_data) {
          details_footer += '<a href="' + link_data + '#enquiry_form" class="button register-button">Register your interest</a>';
          details_footer += '<a href="' + link_data + '" class="button button--secondary">Learn More</a>';
        }
        $(".service_locator-details_footer").append(details_footer);
      }).done(function(data) {
        $(".service_locator-progress").css("z-index", -1).animate({ opacity: 0 }, 300);
        $(".service_locator-details").addClass("open");
        $("body").addClass("overflow-hidden");
      });
    }
    $(".service_locator-details_overlay, .service_locator-details_header .back-button, .service_locator-details_header .close-button").click(function(e) {
      e.preventDefault();
      $(".service_locator-details").removeClass("open");
      $(".service_locator-details").addClass("closed");
      $("body").removeClass("overflow-hidden");
      $(".service_locator-details_body").empty();
      $(".service_locator-details_footer").empty();
    });
    function setMapOnAll(map2) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map2);
      }
    }
    function hideMarkers() {
      setMapOnAll(null);
    }
    function showMarkers() {
      setMapOnAll(map);
    }
    function deleteMarkers() {
      hideMarkers();
      markers = [];
    }
    $("#view-as-list").click(function(e) {
      e.preventDefault();
      $(this).addClass("active");
      $("#view-on-map").removeClass("active");
      $(".service_locator-listing").show();
      $(".service_locator-listing_tabs").show();
      $(".service_locator-map").hide();
    });
    $("#view-on-map").click(function(e) {
      e.preventDefault();
      $(this).addClass("active");
      $("#view-as-list").removeClass("active");
      $(".service_locator-listing").hide();
      $(".service_locator-listing_tabs").hide();
      $(".service_locator-map").show();
    });
  });
})();
