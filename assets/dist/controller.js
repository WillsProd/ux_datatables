import { Controller } from "@hotwired/stimulus";
import DataTable from "datatables.net-dt";

class DataTableController extends Controller {
  static targets = ["viewValue"];
  initialize() {
    const payload = this.viewValue;
    new DataTable(this.element, {
      ...payload,
      initComplete: () => {
        const wrapper = document.querySelector(`#${this.element.id}_wrapper`);
        const input = wrapper?.querySelector('input[type="search"]');
        if (input) {
          input.className = this.viewValue.search_input.className;
        }

        // const select = wrapper?.querySelector(
        //   `select[name="${this.element.id}_length"]`
        // );
        // if (select && this.hasLengthSelectClassValue) {
        //   select.className = this.lengthSelectClassValue;
        // }

        // const pagination = wrapper?.querySelector(".dataTables_paginate");
        // if (pagination && this.hasPaginationClassValue) {
        //   pagination.className = this.paginationClassValue;
        // }
      },
    });
  }
}

DataTableController.values = {
  view: Object,
};

export default DataTableController;
