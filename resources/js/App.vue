<template>
  <b-container>
    <b-row>
      <b-col offset="4" cols="4">
        <b-form @submit="onSubmit" class="mt-5" novalidate :class="loading">
          <h3 class="text-center bold">Valculate Coints</h3>
          <b-form-group id="input-group-1" label="Value" label-for="value">
            <b-form-input
              id="value"
              name="value"
              v-model="form.value"
              type="text"
              placeholder="Please enter the value to evaluate the coins"
              v-validate="'required|decimal'"
              :state="!errors.has('value')"
            ></b-form-input>

            <b-form-invalid-feedback
              id="input-1-live-feedback"
              class="text-danger"
              >{{ errors.first("value") }}</b-form-invalid-feedback
            >
          </b-form-group>

          <b-button type="submit" variant="primary" class="mt-3 mb-5" :disabled="loading"
            >{{loading? 'Loading...': 'Submit'}}</b-button
          >
        </b-form>

				<table-component v-if="coins" :coins="coins"/>
      </b-col>
    </b-row>
  </b-container>
</template>


<script>
import {
  BForm,
  BButton,
  BFormCheckbox,
  BFormCheckboxGroup,
  BFormGroup,
  BFormInput,
  BContainer,
  BRow,
  BCol,
  BFormInvalidFeedback,
} from "bootstrap-vue";

export default {
  components: {
    BFormInvalidFeedback,
    BForm,
    BButton,
    BFormCheckbox,
    BFormCheckboxGroup,
    BFormGroup,
    BFormInput,
    BContainer,
    BRow,
    BCol,
  },

  data() {
    return {
      form: {
        value: "",
      },
      loading: false,
			coins: undefined
    };
  },
  methods: {
    validateState(ref) {
      if (
        this.veeFields[ref] &&
        (this.veeFields[ref].dirty || this.veeFields[ref].validated)
      ) {
        return !this.veeErrors.has(ref);
      }
      return null;
    },

    async onSubmit(e) {
      e.preventDefault();

      if (!(await this.$validator.validateAll())) return;

      this.loading = true;
      try {
				const { data } = await this.$http.post("/calculate", this.form);
				this.coins = data;
			} catch (error) {
				this.error = error.message
			}

			this.loading = false;

    },
  },
};
</script>