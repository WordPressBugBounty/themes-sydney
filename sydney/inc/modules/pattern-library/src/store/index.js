import { createReduxStore, register } from "@wordpress/data";

const STORE_NAME = "sydney/pattern-library";

const DEFAULT_STATE = {
  selectedType: "all",
  isModalOpen: false,
  searchQuery: "",
};

const actions = {
  setType(patternType) {
    return { type: "SET_TYPE", patternType };
  },
  setSearch(query) {
    return { type: "SET_SEARCH", query };
  },
  openModal() {
    return { type: "OPEN_MODAL" };
  },
  closeModal() {
    return { type: "CLOSE_MODAL" };
  },
};

function reducer(state = DEFAULT_STATE, action) {
  switch (action.type) {
    case "SET_TYPE":
      return { ...state, selectedType: action.patternType };
    case "SET_SEARCH":
      return { ...state, searchQuery: action.query, selectedType: "all" };
    case "OPEN_MODAL":
      return { ...state, isModalOpen: true };
    case "CLOSE_MODAL":
      return { ...state, isModalOpen: false, searchQuery: "", selectedType: "all" };
  }
  return state;
}

const selectors = {
  getSelectedType(state) {
    return state.selectedType;
  },
  getSearchQuery(state) {
    return state.searchQuery;
  },
  isModalOpen(state) {
    return state.isModalOpen;
  },
};

const store = createReduxStore(STORE_NAME, { reducer, actions, selectors });
register(store);

export { STORE_NAME };
