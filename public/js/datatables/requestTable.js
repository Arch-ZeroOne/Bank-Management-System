/**
 * Loan Request Management System
 * Clean, maintainable JavaScript code following modern best practices
 *
 * References for clean code principles applied:
 * - Clean Code by Robert C. Martin (Uncle Bob)
 * - MDN JavaScript Best Practices: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide
 * - Airbnb JavaScript Style Guide: https://github.com/airbnb/javascript
 * - Google JavaScript Style Guide: https://google.github.io/styleguide/jsguide.html
 */

// =============================================================================
// CONSTANTS AND CONFIGURATION
// =============================================================================

const API_ENDPOINTS = {
    GET_ALL_REQUESTS: "/loanrequests/getAll",
    GET_SINGLE_REQUEST: "loanrequests/",
    UPDATE_STATUS: "loanrequests/update",
    CREATE_REQUEST: "loanrequests/insert",
    EDIT_REQUEST: "loanrequests/edit",
};

const LOAN_STATUS = {
    APPROVED: "Approved",
    ONGOING: "Ongoing",
    REJECTED: "Rejected",
};

const CSS_CLASSES = {
    VISIBLE: "visible",
    INVISIBLE: "invisible",
    STATUS_APPROVED: "text-green-600 font-bold",
    STATUS_ONGOING: "font-bold",
    STATUS_REJECTED: "text-red-600 font-bold",
};

// =============================================================================
// UTILITY FUNCTIONS
// =============================================================================

/**
 * Gets the base URL for API calls
 * @returns {string} Base URL
 */
const getApplicationBaseUrl = () => {
    return `${location.protocol}//${location.host}`;
};

/**
 * Gets CSRF token from the page
 * @returns {string} CSRF token value
 */
const getCsrfToken = () => {
    const tokenElement = document.querySelector("input[name=_token]");
    return tokenElement ? tokenElement.value : "";
};

/**
 * Shows loading spinner
 */
const displayLoadingSpinner = () => {
    const loaderElement = document.getElementById("loader");
    if (loaderElement) {
        loaderElement.classList.remove(CSS_CLASSES.INVISIBLE);
    }
};

/**
 * Hides loading spinner
 */
const hideLoadingSpinner = () => {
    const loaderElement = document.getElementById("loader");
    if (loaderElement) {
        loaderElement.classList.add(CSS_CLASSES.INVISIBLE);
    }
};

// =============================================================================
// DOM ELEMENT REFERENCES
// =============================================================================

const DOMElements = {
    // Buttons
    btnOpenAddRequestModal: document.getElementById("addRequest"),
    btnSubmitAddRequest: document.getElementById("add-request"),
    btnSubmitUpdateRequest: document.getElementById("update-request"),
    modalCloseButtons: document.querySelectorAll("#exit-request"),

    // Modals
    modalAddRequest: document.getElementById("addRequestModal"),
    modalEditRequest: document.getElementById("editRequestModal"),

    // Table
    requestTable: document.getElementById("requestTable"),
};

// =============================================================================
// DATA TABLE CONFIGURATION
// =============================================================================

/**
 * Renders status with appropriate styling
 * @param {string} statusValue - The status value to render
 * @returns {string} HTML string with styled status
 */
const renderLoanStatusCell = (statusValue) => {
    const statusMap = {
        [LOAN_STATUS.APPROVED]: `<span class="bg-green-100 text-green-600 font-bold px-3 py-1 rounded-full text-sm shadow-sm inline-block">${statusValue}</span>`,
        [LOAN_STATUS.ONGOING]: `<span class="${CSS_CLASSES.STATUS_ONGOING}" style="color:#F7B05B">${statusValue}</span>`,
        [LOAN_STATUS.REJECTED]: `<span class="${CSS_CLASSES.STATUS_REJECTED}">${statusValue}</span>`,
    };

    return statusMap[statusValue] || statusValue;
};

/**
 * Renders action buttons for each row
 * @param {string} loanApprovalId - The loan approval ID
 * @returns {string} HTML string with action buttons
 */
const renderActionButtonsCell = (loanApprovalId) => {
    return `
    <div class="flex justify-center gap-10 p-2 items-center">
      <i class="fa-regular fa-thumbs-up edit-btn text-lg" 
         id="approve" 
         title="Approve Request" 
         data-approve="${loanApprovalId}">
      </i>
      <i class="fa-regular fa-thumbs-down edit-btn text-lg" 
         id="decline" 
         title="Decline Request" 
         data-decline="${loanApprovalId}">
      </i>
      <i class="fa-solid fa-pencil text-lg" 
         id="edit-request" 
         title="Edit Request" 
         data-edit="${loanApprovalId}">
      </i>
    </div>
  `;
};

// Initialize DataTable
const loanRequestDataTable = new DataTable("#requestTable", {
    ajax: getApplicationBaseUrl() + API_ENDPOINTS.GET_ALL_REQUESTS,
    processing: true,
    serverSide: true,
    columnDefs: [{ targets: "_all", visible: true }],
    stateSave: true,
    columns: [
        {
            data: "loan_approval_id",
            name: "loan_approval_id",
            title: "Request ID",
        },
        {
            data: "approval_date",
            name: "approval_date",
            title: "Request Date",
        },
        {
            data: "employee_id",
            name: "employee_id",
            title: "Employee ID",
        },
        {
            data: "loan_id",
            name: "loan_id",
            title: "Loan ID",
        },
        {
            data: "status",
            name: "status",
            title: "Status",
            render: renderLoanStatusCell,
        },
        {
            title: "Actions",
            data: "loan_approval_id",
            render: renderActionButtonsCell,
        },
    ],
});

// =============================================================================
// MODAL MANAGEMENT
// =============================================================================

/**
 * Opens the add request modal
 */
const openAddRequestModal = () => {
    if (DOMElements.modalAddRequest) {
        DOMElements.modalAddRequest.classList.replace(
            CSS_CLASSES.INVISIBLE,
            CSS_CLASSES.VISIBLE
        );
    }
};

/**
 * Opens the edit request modal
 */
const openEditRequestModal = () => {
    if (DOMElements.modalEditRequest) {
        DOMElements.modalEditRequest.classList.replace(
            CSS_CLASSES.INVISIBLE,
            CSS_CLASSES.VISIBLE
        );
    }
};

/**
 * Closes all modals
 */
const closeModals = () => {
    const modals = [DOMElements.modalAddRequest, DOMElements.modalEditRequest];

    modals.forEach((modal) => {
        if (modal) {
            modal.classList.replace(CSS_CLASSES.VISIBLE, CSS_CLASSES.INVISIBLE);
        }
    });
};

// =============================================================================
// API FUNCTIONS
// =============================================================================

/**
 * Fetches loan request data by ID
 * @param {string} requestId - The loan request ID
 * @returns {Promise<Object>} The loan request data
 */
const fetchLoanRequestById = async (requestId) => {
    try {
        const response = await fetch(
            `${API_ENDPOINTS.GET_SINGLE_REQUEST}${requestId}`
        );

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        return data[0]; // Assuming API returns array with single item
    } catch (error) {
        console.error("Error fetching loan request:", error);
        throw error;
    }
};

/**
 * Updates loan status via API
 * @param {string} newStatus - The new status to set
 * @param {string} loanApprovalId - The loan approval ID
 * @returns {Promise<Response>} The fetch response
 */
const updateLoanStatusViaAPI = async (newStatus, loanApprovalId) => {
    const requestPayload = {
        loan_approval_id: loanApprovalId,
        status: newStatus,
    };

    return fetch(API_ENDPOINTS.UPDATE_STATUS, {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": getCsrfToken(),
            Accept: "application/json",
        },
        body: JSON.stringify(requestPayload),
    });
};

/**
 * Creates new loan request via API
 * @param {Object} requestData - The request data
 * @returns {Promise<Response>} The fetch response
 */
const createLoanRequestViaAPI = async (requestData) => {
    return fetch(API_ENDPOINTS.CREATE_REQUEST, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": getCsrfToken(),
            Accept: "application/json",
        },
        body: JSON.stringify(requestData),
    });
};

/**
 * Updates existing loan request via API
 * @param {Object} requestData - The updated request data
 * @returns {Promise<Response>} The fetch response
 */
const updateLoanRequestViaAPI = async (requestData) => {
    return fetch(API_ENDPOINTS.EDIT_REQUEST, {
        method: "PATCH",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": getCsrfToken(),
            Accept: "application/json",
        },
        body: JSON.stringify(requestData),
    });
};

// =============================================================================
// BUSINESS LOGIC FUNCTIONS
// =============================================================================

/**
 * Loads loan request data into edit form
 * @param {string} requestId - The loan request ID to load
 */
const loadLoanRequestIntoEditForm = async (requestId) => {
    displayLoadingSpinner();

    try {
        const loanRequestData = await fetchLoanRequestById(requestId);

        // Populate form fields
        const formFieldMappings = {
            "request-id": loanRequestData.loan_approval_id,
            "request-date": loanRequestData.approval_date,
            "employee-request-id": loanRequestData.employee_id,
            "loan-id": loanRequestData.loan_id,
            "request-status": loanRequestData.status,
        };

        Object.entries(formFieldMappings).forEach(([fieldId, value]) => {
            const element = document.getElementById(fieldId);
            if (element) {
                element.value = value;
            }
        });

        hideLoadingSpinner();
        openEditRequestModal();
    } catch (error) {
        console.error("Failed to load loan request:", error);
        hideLoadingSpinner();

        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Failed to load loan request data.",
        });
    }
};

/**
 * Shows approval confirmation modal
 * @param {string} loanApprovalId - The loan approval ID
 */
const showLoanApprovalConfirmation = (loanApprovalId) => {
    Swal.fire({
        title: "Approve Request?",
        text: "User's loan will be approved",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Approve",
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            processLoanStatusUpdate(LOAN_STATUS.APPROVED, loanApprovalId);
        }
    });
};

/**
 * Shows decline confirmation modal
 * @param {string} loanApprovalId - The loan approval ID
 */
const showLoanDeclineConfirmation = (loanApprovalId) => {
    Swal.fire({
        title: "Decline Request?",
        text: "User's loan will be declined",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Decline",
        cancelButtonText: "Cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            processLoanStatusUpdate(LOAN_STATUS.REJECTED, loanApprovalId);
        }
    });
};

/**
 * Processes loan status update with validation
 * @param {string} newStatus - The new status to set
 * @param {string} loanApprovalId - The loan approval ID
 */
const processLoanStatusUpdate = async (newStatus, loanApprovalId) => {
    try {
        // Check current status first
        const currentLoanData = await fetchLoanRequestById(loanApprovalId);

        if (currentLoanData.status !== LOAN_STATUS.ONGOING) {
            return Swal.fire({
                icon: "error",
                title: "Already Decided",
                text: "This loan has already been approved or rejected.",
            });
        }

        const response = await updateLoanStatusViaAPI(
            newStatus,
            loanApprovalId
        );

        if (response.ok) {
            Swal.fire({
                title: "Status Updated!",
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => Swal.showLoading(),
            }).then(() => {
                loanRequestDataTable.ajax.reload();
            });
        } else {
            throw new Error("Failed to update status");
        }
    } catch (error) {
        console.error("Error updating loan status:", error);
        Swal.fire({
            icon: "error",
            title: "Update Failed",
            text: "Failed to update loan status. Please try again.",
        });
    }
};

/**
 * Shows confirmation for adding new loan request
 */
const showAddLoanRequestConfirmation = () => {
    Swal.fire({
        title: "Confirm Request?",
        text: "Request will be added",
        icon: "question",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            processNewLoanRequestCreation();
        }
    });
};

/**
 * Creates new loan request with form data
 */
const processNewLoanRequestCreation = async () => {
    try {
        const formData = {
            approval_date: document.getElementById("request-date")?.value,
            employee_id: document.getElementById("employee-id")?.value,
            status: LOAN_STATUS.ONGOING,
        };

        // Validate required fields
        if (!formData.approval_date || !formData.employee_id) {
            return Swal.fire({
                icon: "error",
                title: "Missing Information",
                text: "Please fill in all required fields.",
            });
        }

        const response = await createLoanRequestViaAPI(formData);

        if (response.ok) {
            Swal.fire({
                title: "Request Added!",
                timer: 2000,
                didOpen: () => Swal.showLoading(),
            }).then(() => {
                loanRequestDataTable.ajax.reload();
                closeModals();
            });
        } else {
            const errorData = await response.json();
            Swal.fire({
                title: "Error",
                text: errorData.message || "Failed to create request",
                icon: "error",
            });
        }
    } catch (error) {
        console.error("Error creating loan request:", error);
        Swal.fire({
            icon: "error",
            title: "Creation Failed",
            text: "Failed to create loan request. Please try again.",
        });
    }
};

/**
 * Shows confirmation for updating loan request
 */
const showUpdateLoanRequestConfirmation = () => {
    Swal.fire({
        title: "Confirm Update?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Update",
    }).then((result) => {
        if (result.isConfirmed) {
            processLoanRequestUpdate();
        }
    });
};

/**
 * Updates existing loan request with form data
 */
const processLoanRequestUpdate = async () => {
    displayLoadingSpinner();

    try {
        const updatePayload = {
            loan_approval_id: document.getElementById("request-id")?.value,
            approval_date: document.getElementById("request-date")?.value,
            employee_id: document.getElementById("employee-request-id")?.value,
            loan_id: document.getElementById("loan-id")?.value,
            status: document.getElementById("request-status")?.value,
        };

        const response = await updateLoanRequestViaAPI(updatePayload);

        hideLoadingSpinner();

        if (response.ok) {
            Swal.fire({
                title: "Request Updated!",
                timer: 2000,
                didOpen: () => Swal.showLoading(),
            }).then(() => {
                loanRequestDataTable.ajax.reload();
                closeModals();
            });
        } else {
            throw new Error("Update failed");
        }
    } catch (error) {
        hideLoadingSpinner();
        console.error("Update failed:", error);

        Swal.fire({
            icon: "error",
            title: "Update Failed",
            text: "Failed to update loan request. Please try again.",
        });
    }
};

// =============================================================================
// EVENT HANDLERS
// =============================================================================

/**
 * Handles table row clicks for actions
 * @param {Event} event - The click event
 */
const handleTableRowClick = (event) => {
    const { id, dataset } = event.target;

    const actionHandlers = {
        approve: () => showLoanApprovalConfirmation(dataset.approve),
        decline: () => showLoanDeclineConfirmation(dataset.decline),
        "edit-request": () => loadLoanRequestIntoEditForm(dataset.edit),
    };

    const handler = actionHandlers[id];
    if (handler) {
        handler();
    }
};

// =============================================================================
// EVENT LISTENERS SETUP
// =============================================================================

/**
 * Initialize all event listeners
 */
const initializeEventListeners = () => {
    // Table row click events
    if (DOMElements.requestTable) {
        DOMElements.requestTable.addEventListener("click", handleTableRowClick);
    }

    // Modal buttons
    if (DOMElements.btnOpenAddRequestModal) {
        DOMElements.btnOpenAddRequestModal.addEventListener(
            "click",
            openAddRequestModal
        );
    }

    if (DOMElements.btnSubmitAddRequest) {
        DOMElements.btnSubmitAddRequest.addEventListener(
            "click",
            showAddLoanRequestConfirmation
        );
    }

    if (DOMElements.btnSubmitUpdateRequest) {
        DOMElements.btnSubmitUpdateRequest.addEventListener(
            "click",
            showUpdateLoanRequestConfirmation
        );
    }

    // Modal close buttons
    DOMElements.modalCloseButtons.forEach((button) => {
        button.addEventListener("click", closeModals);
    });
};

// =============================================================================
// INITIALIZATION
// =============================================================================

// Initialize the application when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
    initializeEventListeners();
    console.log("Loan Request Management System initialized successfully");
});

// Initialize immediately if DOM is already loaded
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initializeEventListeners);
} else {
    initializeEventListeners();
}
