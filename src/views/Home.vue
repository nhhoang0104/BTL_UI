<template>
  <div>
    <div class="cus-radio-group">
      <div class="header">Tạo dữ liệu cho hệ thống showoff:</div>
      <div class="label">Chọn loại:</div>
      <DxRadioGroup
        :items="dataSrcRadio"
        v-model:value="mode"
        value-expr="value"
        display-expr="label"
        layout="horizontal"
      />
    </div>
    <div class="container">
      <div class="file-uploader-block" v-show="!mode">
        <div>Tải dữ liệu hệ thống đã có:</div>
        <DxFileUploader
          select-button-text="Tải file"
          label-text="Chỉ cho phép file: *.json, *.trealet."
          :allowed-file-extensions="['.json', '.trealet']"
          upload-mode="useForm"
          @value-changed="readFileJson"
        />
      </div>
      <div class="tool">
        <div class="add">
          <div class="title">Thêm mới loại tranh:</div>

          <DxButton
            :width="100"
            text="Thêm"
            type="normal"
            styling-mode="outlined"
            @click="openFormData"
          />
        </div>

        <DxButton
          :width="200"
          text="Xuất file dữ liệu"
          type="normal"
          styling-mode="outlined"
          @click="exportFile"
        />
      </div>
    </div>

    <FormData
      :isShowed="isShowForm"
      @close="closeFormData"
      @save="addNewCategory"
    />
  </div>
</template>

<script>
import FormData from "@/views/FormData.vue";
import { DxFileUploader } from "devextreme-vue/file-uploader";
import DxButton from "devextreme-vue/button";
import DxRadioGroup from "devextreme-vue/radio-group";
import _ from "lodash";

export default {
  components: {
    FormData,
    DxFileUploader,
    DxButton,
    DxRadioGroup,
  },

  data() {
    return {
      isShowForm: false,
      dataSrcRadio: [
        { label: "Thêm dữ liệu", value: 0 },
        { label: "Tạo mới dữ liệu", value: 1 },
      ],
      modelForm: {
        trealet: {
          listTrealet: [],
        },
      },
      dataForm: null,
      mode: 0,
    };
  },

  watch: {
    mode(newVal) {
      if (newVal === 1) {
        this.dataForm = _.cloneDeep(this.modelForm);
      }
    },
  },

  methods: {
    // mở form
    openFormData() {
      this.isShowForm = true;
    },

    // đóng form
    closeFormData() {
      this.isShowForm = false;
    },

    // thêm category
    addNewCategory(categgory = null) {
      this.isShowForm = false;
      if (categgory === null) return;

      if (!this.dataForm) this.dataForm.trealet.listTrealet.push(categgory);
    },

    // xử lý đọc file
    readFileJson({ value }) {
      if (value && value[0]) {
        let file = value[0];
        let fr = new FileReader();

        fr.onload = function(e) {
          try {
            let temp = JSON.parse(e.target.result);
            if (!temp && !temp.trealet)
              this.dataForm = JSON.parse(e.target.result);
          } catch (error) {
            this.dataForm = _.cloneDeep(this.modelForm);
            console.log(error);
          }
        };

        fr.readAsText(file);
      }
    },

    // xuất file
    exportFile() {
      let data = null;
      if (!this.dataForm) {
        data = JSON.stringify(this.modelForm);
      } else {
        data = JSON.stringify(this.dataForm);
      }
      const blob = new Blob([data], { type: "application/json" });

      const link = document.createElement("a");
      link.href = URL.createObjectURL(blob);
      link.download = "dataSrc.trealet";
      link.click();
      URL.revokeObjectURL(link.href);
    },
  },
};
</script>

<style lang="scss">
.cus-radio-group {
  margin: 20px;

  .header {
    padding: 10px 0px;
    font-weight: bold;
    font-size: 36px;
  }

  .label {
    padding: 10px 0px;
    font-weight: bold;
  }
}

.container {
  margin-left: 20px;
  .dx-fileuploader-wrapper {
    padding: 7px 0px;
  }

  .tool {
    display: flex;
    flex-direction: column;
    gap: 10px;
    .add {
      display: flex;
      align-items: center;
      gap: 10px;
      height: 50px;

      .title {
        font-weight: bold;
        margin: 20px 0px;
      }
    }
  }
}
</style>
