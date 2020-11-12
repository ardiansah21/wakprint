<template>
  <ul class="chat">
    <li class="left clearfix" v-for="(message, idx) in messages" :key="idx">
      <div class="chat-body clearfix">
        <div class="header">
          <strong class="primary-font">
            {{ message.user.nama_lengkap }}
          </strong>
        </div>
        <p>
          {{ message.message }}
        </p>
      </div>
    </li>
  </ul>
</template>

<script>
export default {
  props: ["messages"],
};
</script>
