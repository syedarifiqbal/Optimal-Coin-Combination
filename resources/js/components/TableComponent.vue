<template>
  <b-table striped bordered hover :items="items" />
</template>

<script>
import { BTable } from "bootstrap-vue";

export default {
  props: {
    coins: {
      required: true,
    },
  },
  components: { BTable },
	computed: {
		items() {
			return Object.keys(this.coins).map(key => ({ 
				coin: key,
				count: this.coins[key]
			}))
		}
	}
};
</script>
