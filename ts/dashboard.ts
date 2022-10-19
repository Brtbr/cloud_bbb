import axios from '@nextcloud/axios';
import { generateOcsUrl, generateUrl } from '@nextcloud/router';
import { showSuccess, showWarning, showError } from '@nextcloud/dialogs';
import '@nextcloud/dialogs/styles/toast';
import { api } from './Common/Api';
import './filelist.scss';
import 'bootstrap';
import { Offcanvas } from 'bootstrap';
import Vue from '@nextcloud/vue';
import { translate, translatePlural } from '@nextcloud/l10n'

declare var OCA = Vue.OCA