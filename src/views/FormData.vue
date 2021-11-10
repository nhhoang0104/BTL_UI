<template>
  <div class="modal" v-show="isShowed"></div>
  <div class="form-data" v-show="isShowed">
    <div class="header">Thêm mới loại tranh</div>

    <div class="dx-fieldset">
      <div class="dx-field">
        <div class="dx-field-label">Tiêu đề:</div>
        <div class="dx-field-value">
          <DxTextBox :max-length="50" v-model:value="title" />
        </div>
      </div>
    </div>
    <div class="dx-fieldset">
      <div class="dx-field">
        <div class="dx-field-label">Mô tả:</div>
        <div class="dx-field-value">
          <DxTextArea
            :height="100"
            :max-length="1000"
            v-model:value="description"
          />
        </div>
      </div>
    </div>
    <div class="dx-fieldset">
      <div class="dx-field">
        <div class="dx-field-label">Ảnh bìa:</div>
        <div class="dx-field-value">
          <DxTextBox :max-length="50" v-model:value="avatar" />
        </div>
      </div>
    </div>
    <div class="dx-fieldset">
      <div class="dx-field">
        <div class="dx-field-label">
          <div>Danh sách các id ảnh trên hệ thống trealet:</div>
          <div class="hint">(Cách nhau bằng "," hoặc ";")</div>
        </div>
        <div class="dx-field-value">
          <DxTextArea :height="100" :max-length="1000" v-model:value="images" />
        </div>
      </div>
    </div>

    <div class="footer">
      <DxButton
        :width="120"
        text="Đóng"
        type="danger"
        styling-mode="outlined"
        @click="$emit('close')"
      />
      <DxButton
        :width="120"
        text="Lưu"
        type="success"
        styling-mode="outlined"
        @click="save"
      />
    </div>
  </div>
</template>

<script>
import DxTextArea from "devextreme-vue/text-area";
import DxButton from "devextreme-vue/button";
import DxTextBox from "devextreme-vue/text-box";

export default {
  components: {
    DxTextArea,
    DxButton,
    DxTextBox,
  },

  props: {
    dataSrc: {
      type: Object,
      default: null,
    },
    indexItem: { type: Number, default: -1 },

    isShowed: {
      type: Boolean,
      default: false,
    },
  },

  watch: {
    isShowed(newVal) {
      if (newVal) {
        if (!this.dataSrc) {
          this.title = "";
          this.description = "";
          this.avatar = "";
          this.images = "";
        } else {
          this.title = this.dataSrc.title;
          this.description = this.dataSrc.description;
          this.avatar = this.dataSrc.avatar;
          this.images = this.dataSrc.items.toString();
        }
      }
    },
  },

  emits: ["close", "save"],

  data() {
    return {
      title: "",
      description: "",
      avatar: "",
      images: "",
    };
  },

  methods: {
    cleanStr(str) {
      return str
        .split(" ")
        .join("")
        .replace(/\s+/g, "");
    },

    save() {
      let category = { title: "", description: "", items: [] };

      category.title = this.title.trim();
      category.description = this.description.trim();
      category.avatar = this.cleanStr(this.avatar);

      category.items = this.cleanStr(this.images)
        .replace(";", ",")
        .split(",")
        .filter((item) => (item ? item : null));

      this.$emit("save", { exec: "slideshow", ...category }, this.indexItem);
    },
  },
};
</script>

<style lang="scss">
.modal {
  width: 100%;
  height: 100%;
  position: fixed;
  background: #111;
  opacity: 0.5;
  top: 0;
  left: 0;
  z-index: 1;
}

.form-data {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #fff;
  z-index: 9999;
  width: 800px;
  border: 1px solid gray;
  border-radius: 24px;
  padding: 24px;
  box-shadow: 15px 15px 30px -20px rgba(23, 16, 16, 0.5);
  -webkit-box-shadow: 15px 15px 30px -20px rgba(23, 16, 16, 0.5);
  -moz-box-shadow: 15px 15px 30px -20px rgba(23, 16, 16, 0.5);

  .header {
    font-size: 36px;
    font-weight: bold;
  }

  .footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 10px;
    margin-right: 20px;
  }

  .hint {
    font-size: 13px;
    text-align: center;
  }
}
</style>
